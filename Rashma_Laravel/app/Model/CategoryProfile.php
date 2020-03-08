<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CategoryProfile extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-category-profiles";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'category_profiles';

    protected $fillable = ['profileId', 'categoryId', 'range'];

    protected $hidden = ['created_at','updated_at','deleted_at'];
}
