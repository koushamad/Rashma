<?php

namespace App\Services;

use App\Repositories\Mysql\CompanyRepository;
use App\Services\Traits\Addable;
use App\Services\Traits\Searchable;

class CompanyService extends BaseService
{
    use Searchable, Addable;
    /** @var CompanyRepository */
    protected $repository;

    public function __construct(CompanyRepository $companyRepository)
    {
        parent::__construct($companyRepository);
    }
}
