<?php

namespace App\Model;

use App\Model\Traits\Searchable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class University extends Model
{
    use Notifiable, SoftDeletes, Searchable, Cachable;

    protected $cachePrefix = "model-universities";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'universities';

    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at','deleted_at','pivot'];

    protected $target = 'name';
}
