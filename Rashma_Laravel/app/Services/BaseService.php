<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

abstract class BaseService
{
    /** @var BaseRepository */
    protected $repository;

    /**
     * BaseService constructor.
     * @param BaseRepository $mysqlRepository
     */
    public function __construct(BaseRepository $mysqlRepository)
    {
        $this->repository = $mysqlRepository;
    }

    /**
     * @param int|string $id
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function get($id): Collection
    {
        return collect($this->repository->get($id));
    }

    /**
     * @param array $attributes
     * @return Collection
     */
    public function create(array $attributes): Collection
    {
        return collect($this->repository->create($attributes));
    }

    /**
     * @param int|string $id
     * @param array $attributes
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function update($id, array $attributes): bool
    {
        return $this->repository->update($id, $attributes);
    }

    /**
     * @param int|string $id
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function delete($id): bool
    {
        return $this->repository->delete($id);
    }
}
