<?php

namespace App\Services;

use App\Repositories\Mysql\CategoryRepository;
use App\Services\Traits\Addable;
use App\Services\Traits\Searchable;

class CategoryService extends BaseService
{
    use Searchable, Addable;
    /** @var CategoryRepository */
    protected $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }
}
