<?php

namespace App\Repositories\Mysql;

use App\Model\Wallet;
use App\Model\WalletLedger;

class WalletLedgerRepository extends MysqlBaseRepository
{
    /** @var Wallet */
    protected $model;

    /**
     * WalletLedgerRepository constructor.
     * @param WalletLedger $walletLedger
     */
    public function __construct(WalletLedger $walletLedger)
    {
        parent::__construct($walletLedger);
    }
}
