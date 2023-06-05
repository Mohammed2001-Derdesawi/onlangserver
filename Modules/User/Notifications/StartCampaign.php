<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StartCampaign extends Notification
{
    use Queueable;
    public $camp;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($camp)
    {
        $this->camp=$camp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>'Start A new Campaign',
            'message'=>'You have been Started A new Campaign when the someone of your registerd users make a payment of courses cheek your affliate page to see the details of the campaign'
        ];
    }
}
