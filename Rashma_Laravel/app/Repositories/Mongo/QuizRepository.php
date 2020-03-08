<?php


namespace App\Repositories\Mongo;

use App\Model\Quiz;
use Illuminate\Database\Eloquent\Model;

class QuizRepository extends MongoBaseRepository
{
    /** @var Quiz */
    protected $model;

    /**
     * LicenceRepository constructor.
     * @param Quiz $quiz
     */
    public function __construct(Quiz $quiz)
    {
        parent::__construct($quiz);
    }
}
