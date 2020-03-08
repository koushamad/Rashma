<?php

namespace App\Model\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * @param Builder $builder
     * @param string $text
     * @return Builder
     */
    public function scopeSearch(Builder $builder, string $text)
    {
        return isset($this->target) ? $builder->where($this->target, 'Like', '%' . $text . '%') : $builder;
    }

    /**
     * @param Builder $builder
     * @param string $text
     * @return Builder
     */
    public function scopeEqual(Builder $builder, string $text)
    {
        return isset($this->target) ? $builder->where($this->target, $text) : $builder;
    }
}
