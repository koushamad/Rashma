<?php

namespace App\Repositories\Mysql;

use App\Model\Category;
use App\Model\CategoryProfile;
use App\Repositories\Mysql\Traits\Searchable;
use Illuminate\Support\Collection;

class CategoryProfileRepository extends MysqlBaseRepository
{
    use Searchable;
    /** @var Category */
    protected $model;

    /**
     * CategoryRepository constructor.
     * @param CategoryProfile $categoryProfile
     */
    public function __construct(CategoryProfile $categoryProfile)
    {
        parent::__construct($categoryProfile);
    }

    /**
     * @param array $categoryIds
     * @return Collection
     */
    public function getProfilesByCategoryIds(array $categoryIds): Collection {
        $categoryProfiles = collect($this->model->whereIn('id',$categoryIds)->get());
        return  $categoryProfiles->map(function ($categoryProfile) use($categoryIds){
            return collect([
                'profileId' => $categoryProfile->profileId,
                'categoryId' => $categoryProfile->categoryId,
                'range' => $categoryProfile->where('profileId', $categoryProfile->profileId)->sum('range')
            ]);
        })->unique('profileId');
    }
}
