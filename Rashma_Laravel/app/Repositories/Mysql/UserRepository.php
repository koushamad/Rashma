<?php

namespace App\Repositories\Mysql;

use App\Model\Profile;
use App\Model\User;

class UserRepository extends MysqlBaseRepository
{
    /** @var User */
    protected $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
