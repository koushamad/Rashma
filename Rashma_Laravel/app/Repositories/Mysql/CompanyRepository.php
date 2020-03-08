<?php

namespace App\Repositories\Mysql;


use App\Model\Company;
use App\Repositories\Mysql\Traits\Searchable;

class CompanyRepository extends MysqlBaseRepository
{
    use Searchable;
    /** @var Company */
    protected $model;

    /**
     * CompanyRepository constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        parent::__construct($company);
    }
}
