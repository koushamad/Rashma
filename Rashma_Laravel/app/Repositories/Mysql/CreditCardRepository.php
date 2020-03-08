<?php

namespace App\Repositories\Mysql;

use App\Model\CreditCard;
use Facade\FlareClient\Http\Exceptions\NotFound;

class CreditCardRepository extends MysqlBaseRepository
{
    /** @var CreditCard */
    protected $model;

    /**
     * CreditCardRepository constructor.
     * @param CreditCard $creditCard
     */
    public function __construct(CreditCard $creditCard)
    {
        parent::__construct($creditCard);
    }

    /**
     * @param int $walletId
     * @return CreditCard
     * @throws NotFound
     */
    public function getByWalletId(int $walletId): CreditCard
    {
        $result = $this->model->where('walletId', $walletId)->first();
        if (!is_null($result)) {
            return $result;
        }
        throw new NotFound();
    }
}
