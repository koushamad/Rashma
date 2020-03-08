<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /** @var CategoryService */
    protected $service;

    /**
     * CategoryController constructor.
     * @param CategoryService $service
     * @param Request $request
     */
    public function __construct(CategoryService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Search Category
     * @group Category
     * @urlParam text required string
     * @param string $text
     * @return JsonResponse
     */
    public function search(string $text): JsonResponse
    {
        return $this->success(['categories' => $this->service->search($text)->toArray()]);
    }
}
