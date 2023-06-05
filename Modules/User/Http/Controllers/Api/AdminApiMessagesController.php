<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Admin\Entities\Admin;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Message;
use Modules\User\Transformers\UserResource;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\MarkUserMessagesAsRead;
use Modules\User\Http\Requests\MessageRequest;
use Modules\User\Transformers\MessageResource;
use Modules\User\Http\Requests\UserGroupRequest;
use Modules\User\Http\Requests\SendMessageToAUser;
use Modules\User\Http\Requests\MessageGroupRequest;
use Modules\User\Http\Requests\SendMessageToAUserRequest;
use Modules\User\Transformers\MessageGroupResource;
use Modules\User\Repositories\Interfaces\MessageInterface;
use Modules\User\Repositories\Repositories\UserRepository;
use Modules\User\Transformers\RecievedMessagesResourceToAdmin;

class AdminApiMessagesController extends Controller
{

     protected $messageRepo;
     public function __construct(MessageInterface $interface)
     {
        $this->messageRepo=$interface;
     }
    public function getUsers()
    {
        $stdrepo=new UserRepository();
        $paginate=request()->paginate??50;
        $info=$stdrepo->getScopes(["count"]);
        $students=$stdrepo->index([],[],['name','email','id'],$paginate);
        $students->info=$info;
        return new UserResource($students);

      }

      public function getGroups(){
         return MessageGroupResource::collection($this->messageRepo->getGroups([],['id','title'],['users as users']));
      }

      public function storeGroup(MessageGroupRequest $request){
          $message=$this->messageRepo->storeGroup($request);
          return response()->json($message, 200);
      }
      public function deleteGroup($id){
          $message=$this->messageRepo->deleteGroup($id);
          return response()->json($message, 200);
      }
      public function updateGroup($id,MessageGroupRequest $request){
          $message=$this->messageRepo->updateGroup($id,$request);
          return response()->json($message, 200);
      }
      public function addUsersToroup(UserGroupRequest $request){
        $message=$this->messageRepo->addUserToGroup($request);
        return response()->json($message, 200);
      }
      public function deleteUsersFromGroup(UserGroupRequest $request){
        $message=$this->messageRepo->deleteUserFromGroup($request);
        return response()->json($message, 200);
      }

      // get recieved messages to admin
      public function getReceivedMessagesToAdmin($id){

        $messages=$this->messageRepo->getReceivedMessagesToAdmin($id);

        return new  RecievedMessagesResourceToAdmin($messages);
      }
      // end recieved messages to admin

      // get messages between user and admin
       public function getMessagesBetween($user,$admin){
        $messages=$this->messageRepo->getMessagesBetween($user,$admin);
        return MessageResource::collection($messages);
       }
      // end get  messages between user and admin

      // Send Message to a User
      public function SendMessageToUser(SendMessageToAUserRequest $request){
        $message=$this->messageRepo->SendMessageToUser($request);
        return response()->json($message,200);
      }

      // end Message to a user


      // mark user messages As Read
        public function MarkAsRead(MarkUserMessagesAsRead $request){
         $message=$this->messageRepo->markAsRead($request->user);
         return response()->json($message,200);
        }
      // end user messages As Read



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(MessageRequest $request)
    {
       $message=$this->messageRepo->store($request);

         return response()->json($message, 200);
    }


}
