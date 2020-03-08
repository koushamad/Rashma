<?php

namespace App\Notifications;

use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class AlertNotify extends Notification
{
    use Queueable;

    protected $exception;

    /**
     * Create a new notification instance.
     *
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
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
            ->to("#exceptions")
            ->content('Exception Alert ' . Carbon::now())
            ->attachment(function(SlackAttachment $attachment) use ($notifiable) {
                $attachment->fields([
                    'message' => $this->exception->getMessage(),
                    'error' => 'code: ' .$this->exception->getCode() . ' file: ' . $this->exception->getFile() . ' line:  ' . $this->exception->getLine(),
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
            'message' => $this->exception->getMessage(),
            'error' => 'code: ' .$this->exception->getCode() . ' file: ' . $this->exception->getFile() . ' line:  ' . $this->exception->getLine(),
        ];
    }
}
