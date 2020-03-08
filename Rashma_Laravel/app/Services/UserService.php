<?php

namespace App\Services;

use App\Model\User;
use App\Repositories\Mysql\UserRepository;
use Illuminate\Support\Collection;

class UserService extends BaseService
{
    /** @var UserRepository */
    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    /**
     * @param string $phone
     * @param int $code
     * @return Collection
     */
    public function createDefaultUser(string $phone,int $code): Collection
    {
        return collect($this->repository->create(
            [
                'phone' => $phone,
                'code' => $code,
            ]
        ));
    }
}
