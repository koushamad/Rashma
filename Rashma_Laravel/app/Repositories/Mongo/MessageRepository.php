<?php


namespace App\Repositories\Mongo;

use App\Model\Message;
use App\Model\Token;

class MessageRepository extends MongoBaseRepository
{
    /** @var Token */
    protected $model;

    /**
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        parent::__construct($message);
    }

    /**
     * @param $profileId
     * @return Token
     */
    public function getByProfileId($profileId):Token{
        return $this->model->where('profileId',$profileId)-get();
    }
}
