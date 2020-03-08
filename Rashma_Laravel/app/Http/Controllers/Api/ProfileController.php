<?php

namespace App\Http\Controllers\Api;

use App\Services\ProfileService;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileController extends ApiController
{
    /** @var ProfileService */
    protected $service;

    /**
     * ProfileController constructor.
     * @param ProfileService $profileService
     * @param Request $request
     */
    public function __construct(ProfileService $profileService, Request $request)
    {
        parent::__construct($profileService, $request);
    }

    /**
     * Get Profile
     * @group Profile
     * @return JsonResponse
     */
    public function getProfile(): ?JsonResponse
    {
        try {
            return $this->success($this->service->getProfileByUser()->toArray());
        } catch (NotFound $e) {
            return $this->addMessage($e->getMessage())->badRequest();
        }
    }

    /**
     * Update Profile
     * @group Profile
     * @bodyParam fullName string
     * @bodyParam nationalCode string
     * @bodyParam cardNumber string
     * @bodyParam cardNumber string
     * @bodyParam skills array
     * @bodyParam categories array
     * @return JsonResponse
     * @throws NotFound
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function updateProfile(): JsonResponse
    {
        $this->validate(
            $this->request,
            [
                'fullName' => 'nullable|string',
                'nationalCode' => 'nullable|string',
                'cardNumber' => 'nullable|string',
                'skills' => 'array',
                'categories' => 'array',
            ]
        );

        $result = $this->service->updateProfile(
            $this->request->only(
                [
                    'fullName',
                    'nationalCode',
                    'skills',
                    'categories',
                    'cardNumber',
                ]
            )
        );

        return $this->success(['success' => $result]);
    }

    /**
     * Get Profile Enums
     * @group Profile
     * @return JsonResponse
     */
    public function getEnums(): JsonResponse
    {
        return $this->success($this->service->getEnums()->toArray());
    }

    /**
     * Attach Image to profile
     * @bodyParam imageId string
     * @return JsonResponse
     * @throws NotFound
     * @throws ValidationException
     */
    public function attachProfileImage(): JsonResponse
    {
        $this->validate(
            $this->request,
            ['imageId' => 'string']
        );

        $result = $this->service->attachProfile(
            $this->request->only(['imageId'])
        );

        return $this->success(['success' => $result]);
    }

    /**
     * Detach Image to profile
     * @return JsonResponse
     * @throws NotFound
     */
    public function detachProfileImage(): JsonResponse
    {
        $result = $this->service->attachProfile(['imageId' => null]);

        return $this->success(['success' => $result]);
    }
}
