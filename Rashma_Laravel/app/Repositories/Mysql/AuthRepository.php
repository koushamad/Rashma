<?php

namespace App\Repositories\Mysql;

use App\Model\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;

class AuthRepository extends MysqlBaseRepository
{

    /** @var User */
    protected $model;

    /**
     * AuthRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $phone
     * @return Collection
     * @throws NotFound
     */
    public function getByPhone(string $phone): Collection
    {
        $user = $this->model->where('phone',$phone)->first();

        if(isset($user)){
            return collect($user);
        }

        throw new NotFound(trans('error.phone_not_found'));
    }

    /**
     * @param string $phone
     * @param int $code
     * @return User
     * @throws NotFound
     */
    public function checkCode(string $phone, int $code): User
    {
        $user =  $this->model->where('phone', $phone)->where('code', $code)->first();

        if(isset($user)){
            return $user;
        }

        throw new NotFound(trans('error.phone_not_found'));
    }

    /**
     * @param string $token
     * @param string $refreshToken
     * @return User
     * @throws NotFound
     */
    public function checkToken(string $token, string $refreshToken): User
    {
        $user =  $this->model
            ->where('token', base64_encode($token))
            ->where('refreshToken', base64_encode($refreshToken))
            ->first();

        if(isset($user)){
            return $user;
        }

        throw new NotFound(trans('error.token_not_found'));
    }
}
