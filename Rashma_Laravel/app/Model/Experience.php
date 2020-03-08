<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Experience extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $primaryKey = 'id';

    protected $cachePrefix = "model-experiences";

    protected $cacheCooldownSeconds = 10;

    protected $table = 'experiences';

    protected $fillable =['profileId','title','grade','startDate','endDate','companyId'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Company(){
        return $this->belongsTo(Company::class,'companyId','id');
    }

}
