<?php

namespace App\Services;

use App\Repositories\Mysql\ExperienceRepository;
use Illuminate\Support\Collection;

class ExperienceService extends BaseService
{
    /** @var ExperienceRepository */
    protected $repository;

    /** @var ProfileService */
    protected $profileService;

    protected $companyService;

    public function __construct(
        ExperienceRepository $experienceRepository,
        ProfileService $profileService,
        CompanyService $companyService
    ) {
        $this->profileService = $profileService;
        $this->companyService = $companyService;
        parent::__construct($experienceRepository);
    }

    /**
     * @param array $attributes
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function create(array $attributes): Collection
    {
        $attributes['profileId'] = $this->profileService->getProfileByUser()->get('id');
        $attributes['companyId'] = $this->companyService->add([$attributes['company']])[0];
        return parent::create(collect($attributes)->only([
            'profileId','title','grade','startDate','endDate','companyId'
        ])->toArray());
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function update($id, array $attributes): bool
    {
        $attributes['profileId'] = $this->profileService->getProfileByUser()->get('id');
        $attributes['companyId'] = $this->companyService->add([$attributes['company']])[0];
        if ($this->repository->get($id)->profileId == $attributes['profileId']) {
            return parent::update($id, collect($attributes)->only([
                'profileId','title','grade','startDate','endDate','companyId'
            ])->toArray());
        }

        return false;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function delete($id): bool
    {
        $profileId = $this->profileService->getProfileByUser()->get('id');
        if ($this->repository->get($id)->profileId == $profileId) {
            return parent::delete($id);
        }

        return false;
    }

}
