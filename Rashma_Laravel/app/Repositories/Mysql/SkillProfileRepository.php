<?php

namespace App\Repositories\Mysql;

use App\Model\SkillProfile;
use App\Repositories\Mysql\Traits\Searchable;
use Illuminate\Support\Collection;

class SkillProfileRepository extends MysqlBaseRepository
{
    use Searchable;

    /** @var SkillProfile */
    protected $model;

    /**
     * SkillRepository constructor.
     * @param SkillProfile $skill
     */
    public function __construct(SkillProfile $skill)
    {
        parent::__construct($skill);
    }

    /**
     * @param array $skillIds
     * @return Collection
     */
    public function getProfilesBySkillIds(array $skillIds): Collection {
        $skillProfiles = collect($this->model->whereIn('id',$skillIds)->get());
        return  $skillProfiles->map(function ($skillProfile) use($skillProfiles){
            return collect([
                'profileId' => $skillProfile->profileId,
                'skillId' => $skillProfile->skillId,
                'range' => $skillProfiles->where('profileId', $skillProfile->profileId)->sum('range')
            ]);
        })->unique('profileId');
    }
}
