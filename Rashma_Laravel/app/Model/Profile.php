<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Profile extends Model
{
    use Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-profiles";

    protected $cacheCooldownSeconds = 10;

    protected $primaryKey = 'id';

    protected $table = 'profiles';

    protected $fillable = [
        'userId',
        'range',
        'activity',
        'fullName',
        'imageId',
        'nationalCode',
    ];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_profiles', 'profileId', 'skillId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ProfileSkills()
    {
        return $this->hasMany(SkillProfile::class, 'profileId', 'id')->with(['skill']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'category_profiles', 'profileId', 'categoryId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Experiences()
    {
        return $this->hasMany(Experience::class, 'profileId', 'id')->with('Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Licences()
    {
        return $this->hasMany(Licence::class, 'profileId', 'id')->with('University');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Wallet()
    {
        return $this->hasOne(Wallet::class, 'profileId', 'id')->with('CreditCard','Transactions');
    }
}
