<?php

namespace App\Services\Traits;

use Facade\FlareClient\Http\Exceptions\NotFound;

trait Searchable
{
    /**
     * @param string $text
     * @return \Illuminate\Support\Collection
     */
    public function search(string $text){
        return collect($this->repository->search($text));
    }

    /**
     * @param string $text
     * @return \Illuminate\Support\Collection
     */
    public function equal(string $text){
        return collect($this->repository->equal($text));
    }
}
