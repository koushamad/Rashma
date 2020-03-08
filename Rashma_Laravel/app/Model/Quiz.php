<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed isPay
 * @property mixed title
 * @property mixed description
 * @property mixed _id
 */
class Quiz extends Model
{
    use Notifiable, SoftDeletes;

    protected $connection = 'mongodb';

    protected $primaryKey = '_id';

    protected $table = 'quizzes';

    protected $fillable = [
        'title',
        'description',
        'grade',
        'ownerId',
        'responderId',
        'members',
        'categories',
        'messages',
        'skills',
        'isEmergency',
        'isDone',
        'isPay',
        'rate',
        'created_at',
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

    /**
     * @return mixed
     */
    public function getSkillsAttribute(){
        return Skill::whereIn('id',$this->attributes['skills'])->get();
    }

    /**
     * @return mixed
     */
    public function getCategoriesAttribute(){
        return Category::whereIn('id',$this->attributes['categories'])->get();
    }

    /**
     * @return mixed
     */
    public function getMessagesAttribute(){
        return Message::whereIn('_id',$this->attributes['messages'])->get();
    }
}
