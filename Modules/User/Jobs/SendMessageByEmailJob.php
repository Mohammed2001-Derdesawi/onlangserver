<?php

namespace Modules\User\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\User\Emails\SendMessageByEmailMail;

class SendMessageByEmailJob implements ShouldQueue
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
    public function __construct($data,$message,$subject,$sender='support.group@onlanguagecourses.com')
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

        foreach($this->data as $user)
        {
            $message=str_replace('{$name}',$user->name,$this->message);
            $message=str_replace('../../../',config('app.url')."/",$message);

            Mail::to($user->email)->send(new SendMessageByEmailMail($message,$this->subject,$user,$this->sender));
        }

    }
}
