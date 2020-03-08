<?php

namespace App\Services;

use App\Repositories\Mysql\SkillRepository;
use App\Services\Traits\Addable;
use App\Services\Traits\Searchable;

class SkillService extends BaseService
{
    use Searchable, Addable;
    /** @var SkillRepository */
    protected $repository;

    public function __construct(SkillRepository $skillRepository)
    {
        parent::__construct($skillRepository);
    }
}
