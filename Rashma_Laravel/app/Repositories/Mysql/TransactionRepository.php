<?php

namespace App\Repositories\Mysql;

use App\Model\Transaction;

class TransactionRepository extends MysqlBaseRepository
{
    /** @var Transaction */
    protected $model;

    /**
     * TransactionRepository constructor.
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }
}
