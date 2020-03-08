<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Setting extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-settings";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'settings';

    protected $fillable =['userId','lang','isNotify', 'isPublic'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

}
