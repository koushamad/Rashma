<?php

namespace App\Http\Controllers\Api;

use App\Services\UniversityService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UniversityController extends ApiController
{
    /** @var UniversityService */
    protected $service;

    /**
     * UniversityController constructor.
     * @param UniversityService $service
     * @param Request $request
     */
    public function __construct(UniversityService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Search University
     * @group University
     * @urlParam text required string
     * @param string $text
     * @return JsonResponse
     */
    public function search(string $text): JsonResponse
    {
        return $this->success(['universities' => $this->service->search($text)->toArray()]);
    }
}
