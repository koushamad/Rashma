<?php

namespace App\Adapter\Sms;

use App\Adapter\Sms\SmsIr\SmsAdapter;
use App\Model\Quiz;

class SmsService
{
    protected $adapter;

    public function __construct(SmsAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function sendMessage(string $phone, string $message): bool
    {
        return $this->adapter->sendMessage($phone, $message);
    }

    /**
     * @param string $phone
     * @param int $code
     * @return bool
     */
    public function sendAuthApproveMessage(string $phone, int $code): bool
    {
        return $this->sendMessage($phone, trans('message.auth-approve-message', ['code' => $code]));
    }

    /**
     * @param string $phone
     * @param int $code
     * @param float $cash
     * @return bool
     */
    public function sendCashAuthApproveMessage(string $phone, int $code, float $cash): bool
    {
        return $this->sendMessage($phone,
            trans('message.cash-auth-approve-message', ['code' => $code, 'cash' => $cash]));
    }

    /**
     * @param string $phone
     * @param int $code
     * @return bool
     */
    public function sendUserUpdateApproveMessage(string $phone, int $code): bool
    {
        return $this->sendMessage($phone, trans('message.user-update-approve-message', ['code' => $code]));
    }

    /**
     * @param $phone
     * @param Quiz $quiz
     * @return bool
     */
    public function offerQuiz(string $phone ,Quiz $quiz): bool
    {
        $this->sendMessage($phone, trans('message.sms-you-have-new-quiz',[$quiz->title]));
    }
}
