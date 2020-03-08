<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 */
class Message extends Model
{
    use Notifiable, SoftDeletes;

    protected $connection = 'mongodb';

    protected $primaryKey = '_id';

    protected $table = 'messages';

    protected $fillable = [
        'content',
        'type',
        'profileId',
        'quizId',
        'seen',
        'delivered'
    ];

    protected $hidden = ['quizId', 'created_at', 'updated_at', 'deleted_at', '_modified','_created'];

    /**
     * @return mixed
     */
    public function getProfileAttribute(){
        return Profile::where('id',$this->attributes['profileId'])->first();
    }
}
