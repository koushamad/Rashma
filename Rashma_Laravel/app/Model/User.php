<?php

namespace App\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, Cachable;

    protected $cachePrefix = "model-users";

    protected $cacheCooldownSeconds = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'code',
        'token',
        'refreshToken',
        'sid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email_verified_at',
        'phone_verified_at',
        'name',
        'password',
        'remember_token',
        'code',
        'token',
        'refreshToken',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     * @return string
     */
    public function setTokenAttribute($value): string
    {
        return $this->attributes['token'] = base64_encode($value);
    }

    /**
     * @return bool|string
     */
    public function getTokenAttribute()
    {
        return base64_decode($this->attributes['token']);
    }

    /**
     * @param $value
     * @return string
     */
    public function setRefreshTokenAttribute($value): string
    {
        return $this->attributes['refreshToken'] = base64_encode($value);
    }

    /**
     * @return bool|string
     */
    public function getRefreshTokenAttribute()
    {
        return base64_decode($this->attributes['refreshToken']);
    }

    /**
     * get settings
     */
    public function settings()
    {
        return $this->belongsTo(Setting::class, 'UserId', 'id');
    }
}
