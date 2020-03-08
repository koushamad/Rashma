<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Services\QuizService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponse;

    protected $request;
    protected $service;

    /**
     * ApiController constructor.
     * @param BaseService $service
     * @param Request $request
     */
    public function __construct(BaseService $service, Request $request)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * @return JsonResponse
     */
    public function apiNotFound(): JsonResponse
    {
        return $this->addMessage(trans('error.api-not-found'))->notFound();
    }

    function getRequest(): Request
    {
        return $this->request;
    }

}
