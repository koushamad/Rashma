<?php

namespace App\Repositories\Mysql;

use App\Model\Profile;
use Facade\FlareClient\Http\Exceptions\NotFound;

class ProfileRepository extends MysqlBaseRepository
{
    /** @var Profile */
    protected $model;

    /**
     * ProfileRepository constructor.
     * @param Profile $profile
     */
    public function __construct(Profile $profile)
    {
        parent::__construct($profile);
    }

    /**
     * @param int $userId
     * @return profile
     * @throws NotFound
     */
    public function getByUserId(int $userId): Profile
    {
        $profile = $this->model->where('userId', $userId)->with(
            [
                'User',
                'Skills',
                'Categories',
                'Experiences',
                'Licences',
                'Wallet'
            ]
        )->first();

        if (isset($profile)) {
            return $profile;
        }

        throw new NotFound();
    }

    /**
     * @param int $userId
     * @param array $attributes
     * @return bool
     * @throws NotFound
     */
    public function updateByUserId(int $userId, array $attributes): bool
    {
        return $this->getByUserId($userId)->update($attributes);
    }

    /**
     * @param int $userId
     * @param array $skills
     * @return array
     * @throws NotFound
     */
    public function syncSkills(int $userId, array $skills): array
    {
        return $this->getByUserId($userId)->skills()->sync($skills);
    }

    /**
     * @param int $userId
     * @param array $categories
     * @return array
     * @throws NotFound
     */
    public function syncCategories(int $userId, array $categories): array
    {
        return $this->getByUserId($userId)->categories()->sync($categories);
    }
}
