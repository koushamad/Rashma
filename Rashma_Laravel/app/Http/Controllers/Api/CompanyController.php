<?php

namespace App\Http\Controllers\Api;

use App\Services\CompanyService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends ApiController
{
    /** @var CompanyService */
    protected $service;

    /**
     * CompanyController constructor.
     * @param CompanyService $service
     * @param Request $request
     */
    public function __construct(CompanyService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Search Company
     * @group Company
     * @urlParam text required string
     * @param string $text
     * @return JsonResponse
     */
    public function search(string $text): JsonResponse
    {
        return $this->success(['companies' => $this->service->search($text)->toArray()]);
    }
}
