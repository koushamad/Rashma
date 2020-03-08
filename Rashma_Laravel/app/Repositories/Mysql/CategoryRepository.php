<?php

namespace App\Repositories\Mysql;

use App\Model\Category;
use App\Repositories\Mysql\Traits\Searchable;

class CategoryRepository extends MysqlBaseRepository
{
    use Searchable;
    /** @var Category */
    protected $model;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }
}
