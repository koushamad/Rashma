<?php

namespace App\Services;

use App\Enums\SettingEnums;
use App\Repositories\Mysql\WalletRepository;
use Carbon\Carbon;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class WalletService extends BaseService
{
    /** @var WalletRepository */
    protected $repository;

    /**
     * WalletService constructor.
     * @param WalletRepository $wallerRepository
     */
    public function __construct(WalletRepository $wallerRepository)
    {
        parent::__construct($wallerRepository);
    }

    /**
     * @param int $profileId
     */
    public function createDefaultWallet(int $profileId)
    {
        $this->repository->create(
            [
                'profileId' => $profileId,
            ]
        );
    }

    /**
     * @param int $profileId
     * @param string $phone
     * @return bool
     * @throws NotFound
     */
    public function updateWalletUnit(int $profileId, string $phone): bool
    {
        $wallet = $this->repository->getByProfileId($profileId);
        if (is_null($wallet->unit)) {
            return $wallet->update([
                'unit' => $this->getWalletUnitId($phone),
            ]);
        }
        return false;
    }

    /**
     * @param int $profileId
     * @return Collection
     * @throws NotFound
     */
    public function getWalletByProfileId(int $profileId): Collection
    {
        return collect($this->repository->getByProfileId($profileId));
    }

    /**
     * @param int $profileId
     * @return Collection
     * @throws NotFound
     */
    public function getStatistics(int $profileId): Collection
    {
        $wallet = $this->repository->getByProfileId($profileId);

        return collect(
            [
                'cash' => $wallet->cash,
                'unit' => ['id' => $wallet->unit, 'name' => trans('unit.' . SettingEnums::WALLET_UNITS[$wallet->unit])],
                'transactions' => $this->getTransactionsTotal($wallet->transactions),
                'walletLedgers' => $this->getWalletLedgersMonthly($wallet->WalletLedgers),
            ]
        );
    }

    /**
     * @param Collection $walletLedgers
     * @return Collection
     */
    private function getWalletLedgersMonthly(Collection $walletLedgers): Collection
    {
        return collect([
            collect([
                "month" => Carbon::now()->subDays(0)->monthName . '-' . Carbon::now()->subDays(30)->monthName,
                "values" => $walletLedgers->filter(function ($ledger) {
                    return $ledger->created_at < Carbon::now()->subDays(0) && $ledger->created_at > Carbon::now()->subDays(30);
                })->map(function ($ledger) {
                    return collect([
                        'total' => $ledger->total,
                        'cash' => $ledger->cash,
                        'day' => Carbon::make($ledger->created_at)->day,
                    ]);
                })->values()->all(),
            ]),
            collect([
                "month" => Carbon::now()->subDays(30)->monthName . '-' . Carbon::now()->subDays(60)->monthName,
                "values" => $walletLedgers->filter(function ($ledger) {
                    return $ledger->created_at < Carbon::now()->subDays(30) && $ledger->created_at > Carbon::now()->subDays(60);
                })->map(function ($ledger) {
                    return collect([
                        'total' => $ledger->total,
                        'cash' => $ledger->cash,
                        'day' => Carbon::make($ledger->created_at)->day,
                    ]);
                })->values()->all(),
            ]),
            collect([
                "month" => Carbon::now()->subDays(60)->monthName . '-' . Carbon::now()->subDays(90)->monthName,
                "values" => $walletLedgers->filter(function ($ledger) {
                    return $ledger->created_at < Carbon::now()->subDays(60) && $ledger->created_at > Carbon::now()->subDays(90);
                })->map(function ($ledger) {
                    return collect([
                        'total' => $ledger->total,
                        'cash' => $ledger->cash,
                        'day' => Carbon::make($ledger->created_at)->day,
                    ]);
                })->values()->all(),
            ]),
        ]);
    }

    /**
     * @param Collection $transactions
     * @return Collection
     */
    private function getTransactionsTotal(Collection $transactions): Collection
    {
        return collect([
            'cashIn' => $transactions->filter(function ($transaction) {
                return !$transaction->isCashOut;
            })->sum('cash'),
            'cashOut' => $transactions->filter(function ($transaction) {
                return $transaction->isCashOut;
            })->sum('cash'),
        ]);
    }

    /**
     * @param string $phone
     * @return int
     */
    private function getWalletUnitId(string $phone): int
    {
        return config('rashma.account')[substr($phone, 1, 2)]['walletUnits']['id'] ??
            SettingEnums::DEFAULT_WALLET_UNIT_ID;
    }
}
