<?php

namespace App\Http\Controllers\Api;

use App\Services\LicenceService;
use App\Services\SettingService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LicenceController extends ApiController
{
    /** @var LicenceService */
    protected $service;

    /**
     * LicenceController constructor.
     * @param LicenceService $licenceService
     * @param Request $request
     */
    public function __construct(LicenceService $licenceService, Request $request)
    {
        parent::__construct($licenceService, $request);
    }

    /**
     * Create Licence
     * @group Licence
     * @bodyParam title string required
     * @bodyParam grade int required
     * @bodyParam startDate date required
     * @bodyParam endDate date
     * @bodyParam university array required [id => int, name => string]
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
                'university' => 'array',
            ]
        );

        return $this->success(
            $this->service->create($this->request->only(['title', 'grade', 'startDate', 'endDate', 'university']))
                ->toArray()
        );

    }

    /**
     * Update Licence
     * @group Licence
     * @urlParam licenceId required int
     * @bodyParam title string required
     * @bodyParam grade int required
     * @bodyParam startDate date required
     * @bodyParam endDate date
     * @bodyParam university array required [id => int, name => string]
     * @param int $licenceId
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function update(int $licenceId)
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
                'university' => 'array',
            ]
        );

        return $this->success(
            [
                'success' => $this->service->update(
                    $licenceId,
                    $this->request->only(
                        [
                            'title',
                            'grade',
                            'startDate',
                            'endDate',
                            'university',
                        ]
                    )
                ),
            ]
        );
    }

    /**
     * Delete Licence
     * @group Licence
     * @urlParam licenceId required int
     * @param int $licenceId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function delete(int $licenceId)
    {
        return $this->success(['success' => $this->service->delete($licenceId)]);
    }

}
