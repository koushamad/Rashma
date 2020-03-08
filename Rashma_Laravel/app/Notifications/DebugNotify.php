<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\SlackAttachment;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class DebugNotify extends Notification
{
    use Queueable;

    protected $request;
    protected $response;

    /**
     * Create a new notification instance.
     *
     * @param Request $request
     * @param array $response
     */
    public function __construct(Request $request, array $response)
    {
        $this->request = $request;
        $this->response = $response;
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
            ->to("#requests")
            ->content('Debug ' . Carbon::now())
            ->attachment(function(SlackAttachment $attachment) use ($notifiable) {
                $attachment->fields([
                    'Request' => $this->getRequest(),
                    'Response' => $this->getResponse()
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
            'Request' => $this->getRequest(),
            'Response' => $this->getResponse()
        ];
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return json_encode([
            'route' => $this->request->route()->getName(),
            'data' => $this->request->all()
        ],JSON_PRETTY_PRINT);
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return json_encode($this->response,JSON_PRETTY_PRINT);
    }
}
