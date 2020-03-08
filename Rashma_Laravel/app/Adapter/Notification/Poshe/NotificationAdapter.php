<?php

namespace App\Adapter\Sms\SmsIr;

use App\Notifications\SendMessage;
use Illuminate\Support\Facades\Notification;

class NotificationAdapter
{
    /**
     * @param string $notifyToken
     * @param string $message
     * @return bool
     */
    public function sendNotification(string $notifyToken ,string $message):bool{
        Notification::route('slack', config('slack.general'))->notify(new SendMessage($notifyToken,$message));
        return true;
    }
}
