<?php

namespace App\Model;

use App\Model\Traits\Searchable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable, SoftDeletes, Searchable, Cachable;

    protected $cachePrefix = "model-companies";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'companies';

    protected $fillable =['name'];

    protected $hidden = ['created_at','updated_at','deleted_at','pivot'];

    protected $target = 'name';
}
