<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Licence extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-licences";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'licences';

    protected $fillable = ['title', 'grade', 'startDate','endDate','universityId','profileId'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function University(){
        return $this->belongsTo(University::class,'universityId','id');
    }
}
