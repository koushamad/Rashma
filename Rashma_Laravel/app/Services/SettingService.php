<?php

namespace App\Services;

use App\Enums\SettingEnums;
use App\Model\User;
use App\Repositories\Mysql\SettingRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;

class SettingService extends BaseService
{

    /** @var SettingRepository */
    protected $repository;

    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        parent::__construct($settingRepository);
    }

    /**
     * @param int $userId
     * @return \Illuminate\Support\Collection
     * @throws NotFound
     */
    public function getUserSetting(int $userId)
    {
        return collect($this->repository->getSettingByUserId($userId));
    }

    /**
     * @param int $userId
     * @param array $attributes
     * @return bool
     * @throws NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function updateUserSetting(int $userId, array $attributes)
    {
        return $this->repository->update($this->getUserSetting($userId)->get('id'), $attributes);
    }

    /**
     * @param int $userId
     * @param string $phone
     */
    public function createDefaultSetting(int $userId, string $phone)
    {
        $this->repository->create(
            [
                'userId' => $userId,
                'isNotify' => SettingEnums::DEFAULT_IS_NOTIFY,
                'isPublic' => SettingEnums::DEFAULT_IS_PUBLIC,
                'lang' => $this->getLang($phone),
            ]
        );
    }

    /**
     * @param int $userId
     * @param string $phone
     * @return bool
     * @throws NotFound
     */
    public function updatePhone(int $userId, string $phone): bool
    {
        return $this->repository->getSettingByUserId($userId)->update([
            'lang' => $this->getLang($phone),
        ]);
    }

    private function getLang(string $phone){
        return SettingEnums::PHONE_CODE_LANG[substr($phone,1,2)] ?? SettingEnums::DEFAULT_LANG;
    }
}
