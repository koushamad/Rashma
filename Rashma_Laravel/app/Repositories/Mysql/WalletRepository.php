<?php

namespace App\Repositories\Mysql;

use App\Model\Wallet;
use Facade\FlareClient\Http\Exceptions\NotFound;

class WalletRepository extends MysqlBaseRepository
{
    /** @var Wallet */
    protected $model;

    /**
     * WalletRepository constructor.
     * @param Wallet $wallet
     */
    public function __construct(Wallet $wallet)
    {
        parent::__construct($wallet);
    }

    /**
     * @param int $profileId
     * @return Wallet
     * @throws NotFound
     */
    public function getByProfileId(int $profileId): Wallet{
        $result =  $this->model->with(['CreditCard','WalletLedgers'])->where('profileId',$profileId)->first();
        if (!is_null($result)){
            return $result;
        }
        throw new NotFound();
    }
}
