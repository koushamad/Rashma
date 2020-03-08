<?php

namespace App\Repositories\Mysql;

use App\Model\University;
use App\Repositories\Mysql\Traits\Searchable;

class UniversityRepository extends MysqlBaseRepository
{
    use Searchable;

    /** @var University */
    protected $model;

    /**
     * UniversityRepository constructor.
     * @param University $university
     */
    public function __construct(University $university)
    {
        parent::__construct($university);
    }
}
