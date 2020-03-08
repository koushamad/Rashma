<?php

namespace App\Services;

use App\Repositories\Mysql\WalletLedgerRepository;
use App\Repositories\Mysql\WalletRepository;

class WalletLedgerService extends BaseService
{
    /** @var WalletRepository */
    protected $repository;

    public function __construct(WalletLedgerRepository $walletLedgerRepository)
    {
        parent::__construct($walletLedgerRepository);
    }

}
