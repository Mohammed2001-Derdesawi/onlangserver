<?php

namespace Modules\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Entities\Admin;
use Modules\User\Emails\SendMessageByEmailMail;
use Modules\User\Entities\Message;

class SendMessageByWebsiteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $data;
     public $message;
     public $subject;
     public $sender;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$message,$subject,$sender)
    {
        $this->data=$data;
        $this->message=$message;
        $this->subject=$subject;
        $this->sender=$sender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $admin=findById(Admin::class,$this->sender);
        $message='';
        foreach($this->data as $user){
            $message=str_replace('{$name}',$user->name,$this->message);
            Message::create([
                'sender_id'=>$admin->id,
                'sender_type'=>get_class($admin),
                'receiver_type'=>get_class($user),
                'receiver_id'=>$user->id,
                'message'=>$message,
                'title'=>$this->subject
            ]);
            $message='';
        }

    }
}
