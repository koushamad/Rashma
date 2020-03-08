<?php

namespace App\Adapter\Sms\SmsIr;

use App\Notifications\SendMessage;
use Illuminate\Support\Facades\Notification;

class SmsAdapter
{
    public function sendMessage(string $phone ,string $message):bool{
        Notification::route('slack', config('slack.general'))->notify(new SendMessage($phone,$message));
        return true;
    }
}
