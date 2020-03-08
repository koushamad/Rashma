<?php


namespace App\Repositories\Mongo;

use App\Model\Token;

class TokenRepository extends MongoBaseRepository
{
    /** @var Token */
    protected $model;

    /**
     * LicenceRepository constructor.
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        parent::__construct($token);
    }

    /**
     * @param $profileId
     * @return Token
     */
    public function getByProfileId($profileId):Token{
        return $this->model->where('profileId',$profileId)-get();
    }
}
