<?php

namespace App\Repositories\Mysql;


use App\Model\Skill;
use App\Repositories\Mysql\Traits\Searchable;
use Illuminate\Support\Collection;

class SkillRepository extends MysqlBaseRepository
{
    use Searchable;

    /** @var Skill */
    protected $model;

    /**
     * SkillRepository constructor.
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        parent::__construct($skill);
    }
}
