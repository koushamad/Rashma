<?php

namespace App\Repositories\Mysql;


use App\Model\Experience;

class ExperienceRepository extends MysqlBaseRepository
{
    /** @var Experience */
    protected $model;

    /**
     * ExperienceRepository constructor.
     * @param Experience $experience
     */
    public function __construct(Experience $experience)
    {
        parent::__construct($experience);
    }

    /**
     * @param int $profileId
     * @return array
     */
    public function getByProfileId(int $profileId):array {
        return $this->model->where('profileId',$profileId)->get();
    }
}
