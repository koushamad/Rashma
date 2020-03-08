<?php

namespace App\Repositories\Mysql;

use App\Model\Setting;
use Facade\FlareClient\Http\Exceptions\NotFound;

class SettingRepository extends MysqlBaseRepository
{
    /** @var Setting */
    protected $model;

    /**
     * SettingRepository constructor.
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        parent::__construct($setting);
    }

    /**
     * @param int $userId
     * @return Setting
     * @throws NotFound
     */
    public function getSettingByUserId(int $userId): Setting
    {
        $setting = $this->model->where('userId', $userId)->first();
        if (isset($setting)) {
            return $setting;
        }

        throw new NotFound('id not found');

    }
}
