<?php

namespace Modules\User\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\User\Emails\SendMessageByEmailMail;

class ReadFileAndSendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $path;
    public $message;
    public $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($path,$subject,$message)
    {
        $this->path=$path;
        $this->subject=$subject;
        $this->message=$message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = fopen(public_path()."\\".$this->path, "r");

// Read the file in chunks of 50 email addresses
$emails =collect();
while (!feof($file)) {
    $data = fgetcsv($file);
    $user=new User();
    if(is_array($data)){
        $user->name=$data[0];
    $emails->push($user);
    }


    if ($emails->count() >= 20) {
        // Send email to each email address in the chunk
        foreach($emails as $usertemp){
            Mail::to($usertemp->name)->send(new SendMessageByEmailMail($this->message,$this->subject,$usertemp));

        }

        // Clear the collection for the next chunk
        $emails=collect();
    }






}
// send remaining emails
foreach($emails as $usertemp){
    Mail::to($usertemp->name)->send(new SendMessageByEmailMail($this->message,$this->subject,$usertemp));

}



// Close the CSV file
fclose($file);



    }
}
