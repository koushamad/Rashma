<?php


namespace App\Http\Controllers\Api;


use App\Model\Quiz;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends ApiController
{
    /** @var QuizService */
    protected $service;

    /**
     * SkillController constructor.
     * @param QuizService $service
     * @param Request $request
     */
    public function __construct(QuizService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Get Quiz
     * @group Quiz
     * @urlParam quizId required string
     * @param string $quizId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getQuiz(string $quizId)
    {
        return $this->success($this->service->get($quizId)->toArray());
    }

    /**
     * Create Quiz
     * @group Quiz
     * @bodyParam title string
     * @bodyParam description string
     * @bodyParam grade string
     * @bodyParam isEmergency boolean
     * @bodyParam skills array [id , name , id ]
     * @bodyParam categories array [id , name , id ]
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     */
    public function createQuiz()
    {
        $this->validate(
            $this->request,
            [
                'title' => 'string',
                'description' => 'string',
                'grade' => 'numeric',
                'skills' => 'array',
                'categories' => 'array',
                'isEmergency' => 'boolean',
            ]
        );

        $result = $this->service->createQuiz(
            $this->request->only(
                [
                    'profileId',
                    'title',
                    'description',
                    'grade',
                    'categories',
                    'skills',
                    'isEmergency',
                ]
            ));

        return $this->success($result->toArray());
    }

    /**
     * Pay Quiz
     * @group Quiz
     * @urlParam quizId required string
     * @param $quizId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     */
    public function payQuiz(string $quizId){
        return $this->success(['success' => $this->service->payQuiz($this->request->get('profileId'),$quizId)]);
    }

    /**
     * Geq Quizzes
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getQuizzes(){
        return $this->success($this->service->getQuizzes($this->request->get('profileId'))->toArray());
    }

}
