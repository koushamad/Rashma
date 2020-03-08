<?php

namespace App\Http\Controllers\Api;

use App\Enums\SettingEnums;
use App\Model\User;
use App\Services\SettingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SettingController extends ApiController
{
    /** @var SettingService */
    protected $service;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     * @param Request $request
     */
    public function __construct(SettingService $settingService, Request $request)
    {
        parent::__construct($settingService, $request);
    }

    /**
     * Get Setting
     * @group Setting
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getSetting()
    {
        /** @var User $user */
        $user = Auth::user();

        return $this->success($this->service->getUserSetting($user->id)->toArray());
    }

    /**
     * Update Setting
     * @group Setting
     * @bodyParam lang int
     * @bodyParam isNotify boolean
     * @bodyParam isPublic boolean
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function updateSetting()
    {
        /** @var User $user */
        $user = Auth::user();
        $this->validate(
            $this->request,
            [
                'lang' => 'in:' . implode(',', SettingEnums::LANGS),
                'isNotify' => 'boolean',
                'isPublic' => 'boolean',
            ]
        );

        return $this->success(
            [
                'success' => $this->service->updateUserSetting(
                    $user->id,
                    $this->request->only(['lang', 'isNotify', 'isPublic'])
                ),
            ]
        );
    }

}
