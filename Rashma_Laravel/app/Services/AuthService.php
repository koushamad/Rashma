<?php

namespace App\Services;

use App\Adapter\Sms\NotificationService;
use App\Adapter\Sms\SmsService;
use App\Repositories\Mysql\AuthRepository;
use Carbon\Carbon;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AuthService extends BaseService
{

    /** @var AuthRepository */
    protected $repository;
    /** @var SettingService */
    protected $settingService;

    /** @var ProfileService */
    protected $profileService;

    /** @var WalletService */
    protected $walletService;

    /** @var UserService */
    protected $userService;

    /** @var NotificationService */
    protected $smsService;

    /**
     * Set Service Repository
     * PassportService constructor.
     * @param AuthRepository $authRepository
     * @param SettingService $settingService
     * @param ProfileService $profileService
     * @param WalletService $walletService
     * @param UserService $userService
     * @param SmsService $smsService
     */
    public function __construct(AuthRepository $authRepository, SettingService $settingService, ProfileService $profileService, WalletService $walletService, UserService $userService, SmsService $smsService) {
        $this->repository = $authRepository;
        $this->settingService = $settingService;
        $this->profileService = $profileService;
        $this->walletService = $walletService;
        $this->userService = $userService;
        $this->smsService = $smsService;
    }

    /**
     * @param string $phone
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function getCode(string $phone): bool
    {
        $code = rand(1000, 9999);

        try {
            $user = $this->repository->getByPhone($phone);
            $this->repository->update($user->get('id'), ['code' => $code]);
        } catch (NotFound $notFound) {
            $this->setUserDefaultInformation($phone, $code);
        }

        return $this->smsService->sendAuthApproveMessage($phone, $code);
    }

    /**
     * @param string $phone
     * @param int $code
     * @return array
     * @throws Exception
     */
    public function getToken(string $phone, int $code): array
    {
        try {
            $user = $this->repository->checkCode($phone, $code);
            auth()->login($user);
            $profile = $this->profileService->getProfileByUser();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $refreshToken = $user->createToken('TutsForApi')->accessToken;
            $this->repository->update(
                $user->id,
                [
                    'phone_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'code' => null,
                    'token' => $tokenResult->accessToken,
                    'refreshToken' => $refreshToken,
                ]
            );
            $this->walletService->updateWalletUnit($profile->get('id'), $phone);
        } catch (NotFound $notFound) {
            throw new AccessDeniedException(trans('error.code_is_not_match'));
        }

        return [
            'token' => $tokenResult->accessToken,
            'refreshToken' => $refreshToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ];
    }

    /**
     * @param string $token
     * @param string $refreshToken
     * @return array
     * @throws Exception
     */
    public function refreshToken(string $token, string $refreshToken)
    {
        try {
            $user = $this->repository->checkToken($token, $refreshToken);
            auth()->login($user);
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $refreshToken = $user->createToken('TutsForApi')->accessToken;
            $this->repository->update(
                $user->id,
                [
                    'phone_verified_at' => Carbon::now(),
                    'code' => null,
                    'token' => $tokenResult->accessToken,
                    'refreshToken' => $refreshToken,
                ]
            );
        } catch (NotFound $notFound) {
            throw new AccessDeniedException(trans('error.token_is_not_match'));
        }

        return [
            'token' => $tokenResult->accessToken,
            'refreshToken' => $refreshToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
        ];
    }

    /**
     * @param array $attributes
     * @return bool
     */
    public function updateRequest(array $attributes): bool
    {
        $code = rand(1000, 9999);
        $phone = Auth::user()->phone;
        Redis::set($this->getUpdateRequestKey($code), json_encode($attributes), 600);
        return $this->smsService->sendUserUpdateApproveMessage($phone, $code);
    }

    /**
     * @param int $userId
     * @param int $profileId
     * @param int $code
     * @return Collection
     * @throws NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function updateAccept(int $userId, int $profileId, int $code): Collection
    {
        $attributes = collect(json_decode(Redis::get($this->getUpdateRequestKey($code))))->toArray();
        if ($attributes) {
            $attributes['phone_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');

            if ($this->settingService->updatePhone($userId, $attributes['phone']) &&
                $this->update($userId, $attributes)) {
                $this->walletService->updateWalletUnit($profileId, $attributes['phone']);
                Redis::del($this->getUpdateRequestKey($code));

                return $this->get($userId);
            };
        }
        throw new NotFound('error.code-is-invalid');
    }

    /**
     * @param string $phone
     * @param int $code
     */
    protected function setUserDefaultInformation(string $phone, int $code): void
    {
        DB::transaction(
            function () use ($phone, $code) {
                $user = $this->userService->createDefaultUser($phone, $code);
                $this->settingService->createDefaultSetting($user->get('id'), $phone);
                $profile = $this->profileService->createDefaultProfile($user->get('id'));
                $this->walletService->createDefaultWallet($profile->get('id'));
            }
        );
    }

    /**
     * @param int $code
     * @return string
     */
    protected function getUpdateRequestKey(int $code)
    {
        $userId = Auth::user()->id;

        return 'update.request.user.' . $userId . '.' . $code;
    }
}
