<?php

namespace App\Http\Controllers\Api;

use App\Services\ExperienceService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExperienceController extends ApiController
{
    /** @var ExperienceService */
    protected $service;

    /**
     * ExperienceController constructor.
     * @param ExperienceService $experienceService
     * @param Request $request
     */
    public function __construct(ExperienceService $experienceService, Request $request)
    {
        parent::__construct($experienceService, $request);
    }

    /**
     * Create Experience
     * @group Experience
     * @bodyParam title string required
     * @bodyParam grade int required
     * @bodyParam startDate date required
     * @bodyParam endDate date
     * @bodyParam company array required [id => int, name => string]
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function create()
    {
        $grades = collect(config('rashma.experienceGrade'))->map(
            function ($grade) {
                return $grade['id'];
            }
        )->toArray();
        $this->validate(
            $this->request,
            [
                'title' => 'string',
                'grade' => 'in:' . implode(',', $grades),
                'startDate' => 'date',
                'endDate' => 'date|nullable',
                'company' => 'array',
            ]
        );

        return $this->success(
            $this->service->create($this->request->only(['title', 'grade', 'startDate', 'endDate', 'company']))
                ->toArray()
        );

    }

    /**
     * Update Experience
     * @group Experience
     * @urlParam experienceId required int
     * @bodyParam title string required
     * @bodyParam grade int required
     * @bodyParam startDate date required
     * @bodyParam endDate date
     * @bodyParam company array required [id => int, name => string]
     * @param int $experienceId
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function update(int $experienceId)
    {
        $grades = collect(config('rashma.experienceGrade'))->map(
            function ($grade) {
                return $grade['id'];
            }
        )->toArray();
        $this->validate(
            $this->request,
            [
                'title' => 'string',
                'grade' => 'in:' . implode(',', $grades),
                'startDate' => 'date',
                'endDate' => 'date|nullable',
                'company' => 'array',
            ]
        );

        return $this->success(
            [
                'success' => $this->service->update(
                    $experienceId,
                    $this->request->only(
                        [
                            'title',
                            'grade',
                            'startDate',
                            'endDate',
                            'company',
                        ]
                    )
                ),
            ]
        );
    }

    /**
     * Delete Experience
     * @group Experience
     * @urlParam experienceId required int
     * @param int $experienceId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function delete(int $experienceId)
    {
        return $this->success(['success' => $this->service->delete($experienceId)]);
    }

}
