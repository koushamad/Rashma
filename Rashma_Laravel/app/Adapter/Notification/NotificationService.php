<?php

namespace App\Adapter\Sms;

use App\Adapter\Sms\SmsIr\SmsAdapter;
use App\Model\Quiz;

class NotificationService
{
    protected $adapter;

    public function __construct(SmsAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $notifyToken
     * @param string $message
     * @return bool
     */
    public function sendMessage(string $notifyToken, string $message): bool
    {
        return $this->adapter->sendMessage($notifyToken, $message);
    }

    /**
     * @param $notifyToken
     * @param Quiz $quiz
     * @return bool
     */
    public function offerQuiz($notifyToken,Quiz $quiz): bool
    {
        $this->sendMessage($notifyToken, trans('message.you-have-new-quiz-notify',[$quiz->title, $quiz->description, $quiz->_id]));
    }
}
