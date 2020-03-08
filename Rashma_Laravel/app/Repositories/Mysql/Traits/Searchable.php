<?php

namespace App\Repositories\Mysql\Traits;

use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait Searchable
{

    /**
     * @param string $text
     * @return Collection
     */
    public function search(string $text): Collection
    {
        return $this->model->search($text)->get();
    }

    /**
     * @param string $text
     * @return Model
     * @throws NotFound
     */
    public function equal(string $text): Model
    {

        $results = $this->model->equal($text)->first();

        if (!is_null($results)) {
            return $results;
        }

        throw new NotFound(trans('error.equal-not-found'));
    }
}
