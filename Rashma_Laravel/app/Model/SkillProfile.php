<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SkillProfile extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-skill-profiles";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'skill_profiles';

    protected $fillable = ['profileId', 'skillId', 'range','percent', 'name'];

    protected $hidden = ['created_at','updated_at','deleted_at','profileId','skillId', 'id'];

    /**
     * @return float|int
     */
    public function getPercentAttribute(){
        return $this->attributes['range'] * 100 / collect($this->all())->max(['range']);
    }

    public function skill(){
        return $this->belongsTo(Skill::class, 'skillId', 'id');
    }
}
