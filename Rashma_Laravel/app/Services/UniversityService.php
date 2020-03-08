<?php

namespace App\Services;

use App\Repositories\Mysql\UniversityRepository;
use App\Services\Traits\Addable;
use App\Services\Traits\Searchable;

class UniversityService extends BaseService
{
    use Searchable, Addable;

    /** @var UniversityRepository */
    protected $repository;

    public function __construct(UniversityRepository $universityRepository)
    {
        parent::__construct($universityRepository);
    }
}
