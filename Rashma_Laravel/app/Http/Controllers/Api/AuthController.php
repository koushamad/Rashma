<?php

namespace App\Http\Controllers\Api;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class AuthController extends ApiController
{
    /** @var AuthService */
    protected $service;

    /**
     * AuthController constructor.
     * @param AuthService $service
     * @param Request $request
     */
    public function __construct(AuthService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Get Code
     * @group Auth
     * @bodyParam phone string required
     * @return JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function getCode(): JsonResponse
    {
        $this->validate($this->request, ['phone' => 'required|min:9|max:13']);

        return $this->success(['success' => $this->service->getCode($this->request->get('phone'))]);
    }

    /**
     * Get Token
     * @group Auth
     * @bodyParam phone string required
     * @bodyParam code int required
     * @return JsonResponse
     * @throws ValidationException
     */
    public function getToken(): jsonResponse
    {
        $this->validate($this->request, ['phone' => 'required|min:9|max:13', 'code' => 'required|min:4|max:4']);
        $tokens = $this->service->getToken($this->request->get('phone'), $this->request->get('code'));

        return $this->success($tokens);
    }

    /**
     * Refresh Token
     * @group Auth
     * @bodyParam token string required
     * @bodyParam refreshToken string required
     * @return JsonResponse
     * @throws ValidationException
     */
    public function refreshToken(): JsonResponse
    {
        $this->validate($this->request, ['token' => 'required', 'refreshToken' => 'required']);
        $tokens = $this->service->refreshToken(
            $this->request->get('token'),
            $this->request->get('refreshToken')
        );

        return $this->success($tokens);
    }

    /**
     * Update Request
     * @group Auth
     * @bodyParam email string required
     * @bodyParam phone string required
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateRequest()
    {
        $this->validate($this->request, ['email' => 'nullable|email', 'phone' => 'required|min:9|max:13']);

        return $this->success(['success' => $this->service->updateRequest($this->request->only(['email', 'phone']))]);
    }

    /**
     * Update Accept
     * @group Auth
     * @bodyParam code string required
     * @return JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function updateAccept()
    {
        $this->validate($this->request, ['code' => 'required|min:4|max:4']);

        return $this->success($this->service->updateAccept(
            $this->request->get('userId'),
            $this->request->get('profileId'),
            $this->request->get('code')
            )->toArray()
        );
    }
}
