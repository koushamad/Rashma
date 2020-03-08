<?php

namespace App\Services;

use App\Repositories\Mysql\ExperienceRepository;
use App\Repositories\Mysql\LicenceRepository;
use Illuminate\Support\Collection;

class LicenceService extends BaseService
{
    /** @var ExperienceRepository */
    protected $repository;

    /** @var ProfileService */
    protected $profileService;

    /** @var UniversityService */
    protected $universityService;

    public function __construct(
        LicenceRepository $licenceRepository,
        ProfileService $profileService,
        UniversityService $universityService
    ) {
        $this->profileService = $profileService;
        $this->universityService = $universityService;
        parent::__construct($licenceRepository);
    }

    /**
     * @param array $attributes
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function create(array $attributes): Collection
    {
        $attributes['profileId'] = $this->profileService->getProfileByUser()->get('id');
        $attributes['universityId'] = $this->universityService->add([$attributes['university']])[0];
        return parent::create(collect($attributes)->only([
            'profileId','title','grade','startDate','endDate','universityId'
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
        $attributes['universityId'] = $this->universityService->add([$attributes['university']])[0];
        if ($this->repository->get($id)->profileId == $attributes['profileId']) {
            return parent::update($id, collect($attributes)->only([
                'profileId','title','grade','startDate','endDate','universityId'
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
