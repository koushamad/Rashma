<?php

namespace App\Model;

use App\Model\Traits\Searchable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Skill
 * @package App\Model
 */
class Skill extends Model
{
    use Notifiable, SoftDeletes, Searchable, Cachable;

    protected $cachePrefix = "model-skills";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'skills';

    protected $fillable =['name'];

    protected $hidden = ['created_at','updated_at','deleted_at','pivot'];

    protected $target = 'name';

    /**
     * @return mixed
     */
    public function rating(){
        return $this->hasMany(SkillProfile::class,'skillId','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Profiles(){
        return $this->belongsToMany(Profile::class,'skill_profiles','skillId', 'profileId');
    }
}
