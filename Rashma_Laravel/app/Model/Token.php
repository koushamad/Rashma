<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed profileId
 * @property mixed notifyToken
 * @property mixed socketToken
 */
class Token extends Model
{
    use Notifiable, SoftDeletes;

    protected $connection = 'mongodb';

    protected $primaryKey = '_id';

    protected $table = 'tokens';

    protected $fillable = [
        'profileId',
        'notify',
        'socket'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
