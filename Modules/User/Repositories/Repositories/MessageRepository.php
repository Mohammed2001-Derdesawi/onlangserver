<?php

namespace Modules\User\Repositories\Repositories;

use Modules\User\Entities\User;
use Modules\Admin\Entities\Admin;
use Modules\User\Entities\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\MessageGroup;
use Modules\User\Jobs\ReadFileAndSendEmails;
use Modules\User\Jobs\SendMessageByEmailJob;
use Modules\User\Jobs\SendMessageByWebsiteJob;
use Modules\User\Repositories\Interfaces\MessageInterface;
use Modules\Course\Repositories\Repositories\CourseRepository;



class MessageRepository implements MessageInterface{

    protected $filecsvpath="outside";
    // public function getToAdmin($relations=[],$count=[],$params=['*'],$paginate=10){

    // }
    public function store($request){
        if($request->type=='website')
       return  $this->sendMessageByWebsite($request);
        elseif($request->type=='email')
        return $this->sendMessagesByEmail($request);

        $this->sendMessageByWebsite($request);
        $this->sendMessagesByEmail($request);
        return [
            'message'=>[
               'text'=>'تم إرسال الرسائل إلى البريد والموقع معا بنجاح شكرا لك',
               'title'=>'تم إرسال الرسائل'
            ]
         ];


    }
    public function getGroups($relations=[],$params=['*'],$count=[])
    {
        return MessageGroup::select($params)->with($relations)->withCount($count)->get();
    }
    public function storeGroup($request){
        MessageGroup::create([
            'title'=>$request->title
        ]);
        return [
            'message'=>[
                'title'=>'نجاح العملية',
               'text'=>'تم إضافة المجموعة بنجاح شكرا لك',
            ]
         ];
    }
    public function updateGroup($id,$request){
        $group=findById(MessageGroup::class,$id);
        $group->update([
            'title'=>$request->title
        ]);
        return [
            'message'=>[
                'title'=>'نجاح العملية',
               'text'=>'تم تعديل عنوان المجموعة بنجاح شكرا لك',
            ]
         ];
    }
    public function deleteGroup($id){
        $group=findById(MessageGroup::class,$id);
        $group->delete();
        return [
            'message'=>[
                'title'=>'نجاح العملية',
               'text'=>'تم حذف  المجموعة بنجاح شكرا لك',
            ]
         ];
    }
    public function markAsRead($id){
       $user=findById(User::class,$id);
       $user->sentMessages()->update([
        'read_at'=>now()
       ]);
       return [
        'message'=>"User messages Mark As read"
       ];
    }
    public function deleteUserFromGroup($request){
        foreach($request->groups as $group){
            $group=findById(MessageGroup::class,$group,[],['id']);
            $group->users()->detach($request->users);
        }
        return [
            'message'=>[
                'title'=>'نجاح العملية',
               'text'=>'تم حذف الطلاب من المجموعة  بنجاح شكرا لك',
            ]
         ];
    }
    public function addUserToGroup($request){
        foreach($request->groups as $group){
            $group=findById(MessageGroup::class,$group,[],['id']);
            $group->users()->syncWithoutDetaching($request->users);
        }
        return [
            'message'=>[
                'title'=>'نجاح العملية',
               'text'=>'تم إضافة الطلاب إلى المجموعة  بنجاح شكرا لك',
            ]
         ];

    }

    public function getMessagesAdmin(){


        return findById(Admin::class,auth()->guard('admin')->user()->id,[],['id'],['UnReardreceivedMessages as receieved_messages']);
    }
    public function getReceivedMessagesToAdmin($id){
        $admin=findById(Admin::class,$id,[],['id']);
        $messages=Message::with(['sender'=>function($q) use($admin){
            $q->select('id','name','email','image')->with(['lastSentMessage']);
        }])->where('receiver_type',get_class($admin))->where('receiver_id',$admin->id)->search()->whereNull('read_at')->groupBy('sender_id')->paginate(14);

        return $messages;

    }
    // send message from admin to a user

    public function SendMessageToUser($request){
        $admin=findById(Admin::class,$request->from,[],['id']);
        $user=findById(User::class,$request->to,[],['id']);
        $message=$admin->sentMessages()->create([
            'receiver_type'=>get_class($user),
            'receiver_id'=>$user->id,
            'message'=>$request->message,

        ]);

        return $message;
    }

    // end  send message from admin to a user


    // get Message between selected user and admin
    public function getMessagesBetween($user,$admin){
       $admin=findById(Admin::class,$admin);
       $user=findById(User::class,$user);

       $messages=Message::where(function($q) use($user,$admin){
        $q->where('sender_id',$user->id)->where('sender_type',get_class($user))
        ->orwhere(function($q) use($admin){
            $q->where('sender_id',$admin->id)->where('sender_type',get_class($admin));
           });
       })->where(function($q) use($user,$admin){
        $q->where('receiver_id',$user->id)->where('receiver_type',get_class($user))
        ->orwhere(function($q) use($admin){
            $q->where('receiver_id',$admin->id)->where('receiver_type',get_class($admin));
           });
       })->get();
       return $messages;
    }

   // end get Message between selected user and admin
   public function sendMessageByWebsite($request)
   {
       $userrepo=new UserRepository();

        if(!$request->sendToAllusers){
           $users=$userrepo->getmodel([],['name','email','id'],[])->whereIn('id',$request->users)->chunk(20,function($data) use($request){
               dispatch(new SendMessageByWebsiteJob($data,$request->message,$request->subject,$request->sender_id));
            });
        }
        else{
           $users=$userrepo->getmodel([],['name','email','id'],[])->chunk(10,function($data) use($request){
               dispatch(new SendMessageByWebsiteJob($data,$request->message,$request->subject,$request->sender_id));
            });
        }



         return [
            'message'=>[
               'text'=>'تم إرسال الرسائل إلى الطلاب   بنجاح شكرا لك',
               'title'=>'تم إرسال الرسائل'
            ]
         ];
   }

   public function sendMessagesByEmail($request){
    $userrepo=new UserRepository();
    $sender='support.group@onlanguagecourses.com';
    if($request->sender)
    $sender=$request->sender;

    if(!$request->sendToAllusers){
    $users=$userrepo->getmodel([],['name','email','id'],[])->whereIn('id',$request->users)->chunk(20,function($data) use($request,$sender){
       dispatch(new SendMessageByEmailJob($data,$request->message,$request->subject,$sender));
    });
    }
    else{
        $users=$userrepo->getmodel([],['name','email','id'],[])->chunk(10,function($data) use($request,$sender){
            dispatch(new SendMessageByEmailJob($data,$request->message,$request->subject,$sender));
         });
    }

    return [
       'message'=>[
          'text'=>'تم إرسال الرسائل إلى البريد  بنجاح شكرا لك',
          'title'=>'تم إرسال الرسائل'
       ]
    ];
    }

    // send message to outside emails
    public function outsideMessagesSent($request){
        $path='storage\\'.$this->filecsvpath."\\".storeImage($this->filecsvpath,$request->file);

         dispatch(new ReadFileAndSendEmails($path,$request->subject,$request->message));
         return;

    }
    // end  send message to outside emails

    // get user messages
    public function userMessages()
    {
        $user=auth()->user()->load(['receivedMessages','sentMessages']);
        // $user=findById(User::class,$user->id,['sentMessages','receivedMessages']);
        $messages=$user->sentMessages->merge($user->receivedMessages)->sortBy('created_at');
        $user->receivedMessages()->update([
            'read_at'=>now()
        ]);

        return [$messages,$user];

    }

    // send Message from user to a admin

    public function sendMessageToAdmin($request){
        $user=auth()->user();
        // $user=findById(User::class,$user->id);
        $message=$user->sentMessages()->create([
            'receiver_id'=>1,
            'receiver_type'=>'Modules\Admin\Entities\Admin',
            'message'=>$request->message
        ]);
        return $message;

        // $user=auth()->user()->load(['UnReardreceivedMessages','unreadNotifications']);
        // $notifications=$user->UnReardreceivedMessages->merge($user->unreadNotifications);
        // count($notifications);
        // foreach($notifications as $notification){
        //     if(get_class())
        // }

    }

}
