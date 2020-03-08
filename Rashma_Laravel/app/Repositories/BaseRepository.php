<?php

namespace App\Repositories;

use Exception;
use Facade\FlareClient\Http\Exceptions\MissingParameter;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    /** @var Model */
    protected $model;

    /**
     * MysqlRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int|string $id
     * @return Model
     * @throws NotFound
     */
    public function get($id): Model
    {
        $result = $this->model->find($id);

        if (isset($result)) {
            return $result;
        }

        throw new NotFound(trans('error.id_not_found'));
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }


    /**
     * @param int|string $id
     * @param array $attributes
     * @return bool
     * @throws NotFound
     * @throws MissingParameter
     */
    public function update($id, array $attributes): bool
    {
        if (!$this->get($id)->update($attributes)) {
            throw new MissingParameter(trans('error.update_failed'));
        }

        return true;
    }

    /**
     * @param int|string $id
     * @return bool
     * @throws NotFound
     * @throws Exception
     * @throws MissingParameter
     */
    public function delete($id): bool
    {
        if ($this->get($id)->delete()) {
            return true;
        }

        throw new MissingParameter(trans('error.delete_failed'));
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}
