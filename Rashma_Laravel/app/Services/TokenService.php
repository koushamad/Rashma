<?php

namespace App\Services;

use App\Repositories\Mongo\TokenRepository;
use Illuminate\Support\Collection;

class TokenService extends BaseService
{
    /** @var TokenRepository */
    protected $repository;

    public function __construct(TokenRepository $tokenRepository)
    {
        parent::__construct($tokenRepository);
    }

    /**
     * @param $profileId
     * @return Collection
     */
   public function getByProfileId($profileId){
        return collect($this->repository->getByProfileId($profileId));
   }
}
