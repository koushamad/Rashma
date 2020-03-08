<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class CreateQuizNotify extends Notification
{
    use Queueable;

    public $phone;
    public $message;
    public $url;

    /**
     * Create a new notification instance.
     *
     * @param string $phone
     * @param string $message
     * @param string $url
     */
    public function __construct(string $phone, string $message, string $url)
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage())
            ->to("#general")
            ->content('Debug ' . Carbon::now())
            ->attachment(function(SlackAttachment $attachment) use ($notifiable) {
                $attachment->fields([
                    'phone' => $this->phone,
                    'message' => $this->message,
                    'url' => $this->url,
                ]);
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'phone' => $this->phone,
            'message' => $this->message,
            'url' => $this->url,
        ];
    }
}
