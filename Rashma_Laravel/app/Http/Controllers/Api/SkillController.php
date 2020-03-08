<?php

namespace App\Http\Controllers\Api;

use App\Services\SkillService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends ApiController
{
    /** @var SkillService */
    protected $service;

    /**
     * SkillController constructor.
     * @param SkillService $service
     * @param Request $request
     */
    public function __construct(SkillService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Search Skill
     * @group Skill
     * @urlParam text required string
     * @param string $text
     * @return JsonResponse
     */
    public function search(string $text): JsonResponse
    {
        return $this->success(['skills' => $this->service->search($text)->toArray()]);
    }
}
