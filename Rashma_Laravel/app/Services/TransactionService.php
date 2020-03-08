<?php

namespace App\Services;

use App\Adapter\Sms\SmsService;
use App\Enums\SettingEnums;
use App\Repositories\Mysql\TransactionRepository;
use Facade\FlareClient\Http\Exceptions\BadResponse;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TransactionService extends BaseService
{
    /** @var TransactionRepository */
    protected $repository;

    /** @var WalletService */
    protected $walletService;

    /** @var WalletLedgerService */
    protected $walletLedgerService;

    /** @var SettingService */
    protected $settingService;

    /** @var SmsService */
    protected $smsService;

    /** @var UserService */
    protected $userService;

    /** @var ProfileService */
    protected $profileService;

    public function __construct(
        TransactionRepository $transactionRepository,
        WalletService $walletService,
        WalletLedgerService $walletLedgerService,
        SettingService $settingService,
        SmsService $smsService,
        UserService $userService,
        ProfileService $profileService
    ) {
        $this->walletService = $walletService;
        $this->walletLedgerService = $walletLedgerService;
        $this->settingService = $settingService;
        $this->smsService = $smsService;
        $this->userService = $userService;
        $this->profileService = $profileService;
        parent::__construct($transactionRepository);
    }

    /**
     * @param int $userId
     * @param int $profileId
     * @param float $cash
     * @return Collection
     */
    public function cashInRequest(int $userId, int $profileId, float $cash): Collection
    {
        $callbackKey = $this->getKey();
        Redis::set(
            $callbackKey,
            json_encode(
                [
                    'userId' => $userId,
                    'profileId' => $profileId,
                    'cash' => $cash,
                ]
            ),
            10
        );

        return collect(
            [
                'redirect' => config('rashma.transactionCallback') . rawurlencode($callbackKey),
            ]
        );
    }

    /**
     * @param string $callbackKey
     * @return Collection
     * @throws NotFound
     */
    public function redirectCashIn(string $callbackKey): Collection
    {
        $data = collect(json_decode(Redis::get($callbackKey)));
        $trackNumber = $this->getKey();
        if ($data->get('userId')) {
            $wallet = $this->walletService->getWalletByProfileId($data->get('profileId'));
            $data->put('unit', $wallet->get('unit'));
            $data->put('unitName', trans('unit.' . SettingEnums::WALLET_UNITS[$wallet->get('unit')]));
            $data->put('callbackKey', $callbackKey);
            $data->put('trackNumber', $trackNumber);
            Redis::del($callbackKey);
            Redis::set($trackNumber, json_encode($data->toArray()), 720);

            return $data;
        }

        throw new NotFound(trans('error.callback-is-not-match'));

    }

    /**
     * @param string $callbackKey
     * @param string $trackNumber
     * @return bool
     * @throws NotFound
     * @throws BadResponse
     */
    public function approveCashIn(string $callbackKey, string $trackNumber): bool
    {
        $data = collect(json_decode(Redis::get($trackNumber), true));
        Redis::del($trackNumber);
        if ($data->get('userId')) {
            if ($data->get('callbackKey') === $callbackKey) {
                return $this->add(
                    $data->get('profileId'),
                    $data->get('cash'),
                    false,
                    $data->get('unit'),
                    $data->get('trackNumber')
                );
            }
        }

        Log::emergency('approveCashIn error data : ' . json_encode([
                'callbackKey' => $callbackKey,
                'trackNumber' => $trackNumber,
                'data' => $data ?? ''
            ], JSON_PRETTY_PRINT));

        return false;
    }

    /**
     * @param float $cash
     * @param int $userId
     * @param int $profileId
     * @return bool
     * @throws BadResponse
     * @throws NotFound
     */
    public function cashOutRequest(float $cash, int $userId, int $profileId): bool
    {
        $wallet = $this->walletService->getWalletByProfileId($profileId);

        if (($wallet->get('cash') - config('rashma.unitDeposit')[$wallet->get('unit')]) >= ($cash * -1)) {
            $code = rand(1000, 9999);
            Redis::set($this->getKey($userId . $profileId . $code), json_encode([
                'code' => $code,
                'cash' => $cash,
                'unit' => $wallet->get('unit'),
            ]), 60);
            $user = $this->userService->get($userId);
            return $this->smsService->sendCashAuthApproveMessage($user->get('phone'), $code, $cash);
        }

        throw new BadResponse(trans('error.wallet.availability.is.not.enough'));
    }

    /**
     * @param int $code
     * @param int $userId
     * @param int $profileId
     * @return bool
     * @throws BadResponse
     * @throws NotFound
     */
    public function cashOutApprove(int $code, int $userId, int $profileId): bool
    {
        $data = collect(json_decode(Redis::get($this->getKey($userId . $profileId . $code)), true));

        Redis::del($this->getKey($userId . $profileId . $code));

        if ($data->get('code') === $code) {
            return $this->add($profileId, $data->get('cash'), true, $data->get('unit'));
        }

        throw new BadResponse(trans('error.code-is-not-match'));
    }

    /**
     * @param int $profileId
     * @param float $cash
     * @param int $unit
     * @param bool $isCashOut
     * @param string|null $trackNumber
     * @return bool
     * @throws BadResponse
     * @throws NotFound
     */
    public function add($profileId, $cash, $isCashOut, $unit = null, $trackNumber = null): bool
    {
        $wallet = $this->walletService->getWalletByProfileId($profileId);
        $unit = $unit ?? $wallet->get('unit');
        $deposit = collect($this->profileService->getEnums($profileId)->get('account'))['walletUnits']['deposit'];
        
        if ($isCashOut && $wallet->get('cash') <= ($cash + $deposit)) {
            throw new BadResponse(trans('error.money-is-not-enough'));
        }

        if ($wallet->get('unit') !== $unit){
            throw new BadResponse(trans('error.transaction-unit-error'));
        }

        $cash = $isCashOut && $cash > 0 ? ($cash * -1) : $cash;

        DB::transaction(function () use ($profileId, $unit, $cash, $wallet, $trackNumber, $isCashOut) {
            $transaction = $this->create([
                'creditCardId' => collect($wallet->get('credit_card'))->get('id'),
                'walletId' => $wallet->get('id'),
                'cash' => $cash,
                'unit' => $unit,
                'trackNumber' => $trackNumber,
                'isCashOut' => $isCashOut,
                'isTransfer' => $trackNumber !== null,
            ]);

            $this->walletService->update($wallet->get('id'), [
                'cash' => ($wallet->get('cash') + $cash),
            ]);

            $this->walletLedgerService->create([
                'walletId' => $wallet->get('id'),
                'transactionId' => $transaction->get('id'),
                'profileId' => $profileId,
                'cash' => $cash,
                'total' => ($wallet->get('cash') + $cash),
            ]);
        });

        return true;

    }

    /**
     * @param null $key
     * @return string
     */
    private function getKey($key = null): string
    {
        return $key ? base64_encode($key) : Hash::make(rand(1000000000, 9999999999));
    }
}
