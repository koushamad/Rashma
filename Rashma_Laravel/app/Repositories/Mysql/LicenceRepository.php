<?php

namespace App\Repositories\Mysql;


use App\Model\Licence;

class LicenceRepository extends MysqlBaseRepository
{
    /** @var Licence */
    protected $model;

    /**
     * LicenceRepository constructor.
     * @param Licence $licence
     */
    public function __construct(Licence $licence)
    {
        parent::__construct($licence);
    }
}
