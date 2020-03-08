<?php

namespace App\Services;

use App\Events\FireQuizEvent;
use App\Model\Quiz;
use App\Repositories\Mongo\QuizRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class QuizService extends BaseService
{
    /** @var QuizRepository */
    protected $repository;
    protected $skillService;
    protected $categoryService;
    protected $profileService;
    protected $walletService;
    protected $transactionService;
    protected $messageService;

    public function __construct(
        QuizRepository $quizRepository,
        SkillService $skillService,
        CategoryService $categoryService,
        ProfileService $profileService,
        WalletService $walletService,
        TransactionService $transactionService,
        MessageService $messageService
    ) {
        $this->skillService = $skillService;
        $this->categoryService = $categoryService;
        $this->profileService = $profileService;
        $this->walletService = $walletService;
        $this->transactionService = $transactionService;
        $this->messageService = $messageService;
        parent::__construct($quizRepository);
    }

    /**
     * @param array $attributes
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     */
    public function createQuiz(array $attributes): Collection
    {
        $attributes = collect($attributes);
        /** @var Quiz $quiz */
        $quiz = $this->repository->create($attributes->only([
            'title',
            'description',
            'grade',
            'isEmergency',
        ])->merge([
            'ownerId' => $attributes->get('profileId'),
            'responderId' => config('rashma.rootProfileId'),
            'members' => [config('rashma.rootProfileId'), $attributes->get('profileId')],
            'messages' => [],
            'categories' => $this->categoryService->add($attributes->get('categories')),
            'skills' => $this->skillService->add($attributes->get('skills')),
            'rate' => 0,
            'isDone' => false,
            'isPay' => false,
        ])->toArray());

        $this->addMessage($quiz, $this->messageService->create([
            'content' => $quiz->title . ' \n ' . $quiz->description,
            'type' => 1,
            'profileId' => config('rashma.rootProfileId'),
            'delivered' => Carbon::now()->unix()
        ]));

        return collect($quiz);
    }

    /**
     * @param int $grade
     * @return float
     */
    private function quizPrice(int $grade): float
    {
        return collect($this->profileService->getEnums()['account']['quizGrade'])->where('id',
            $grade)->first()['price'];
    }

    /**
     * @param $profileId
     * @param $quizId
     * @return bool
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     */
    public function payQuiz($profileId, $quizId): bool
    {
        /** @var Quiz $quiz */
        $quiz = $this->repository->get($quizId);

        if ($quiz->isPay) {
            return true;
        }

        $quiz->update([
            'isPay' => $this->transactionService->add(
                $profileId,
                $this->quizPrice($this->get($quizId)->get('grade')),
                false
            )
        ]);

//        $this->activeQuiz($quiz);

        return $quiz->isPay;
    }

    /**
     * @param Quiz $quiz
     */
    private function activeQuiz(Quiz $quiz): void
    {
        if ($quiz->isPay) {
            event(new FireQuizEvent($quiz));
        }
    }

    /**
     * @param Quiz $quiz
     * @param Collection $message
     * @return bool
     */
    private function addMessage(Quiz $quiz,Collection $message): bool {
        $quiz->messages = collect($quiz->messages)->add($message->get('_id'))->toArray();
        return $quiz->save();
    }

    /**
     * @param int $profileId
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getQuizzes(int $profileId): Collection{
        return collect([
            'statistics' => $this->profileService->getSkillsRange($profileId),
            'quizzes' => $this->repository->getModel()
                ->where('ownerId' , $profileId)
                ->orderBy('created_at', 'DESC')
                ->get(),
            'answers' => $this->repository->getModel()
                ->where('responders' , $profileId)
                ->orderBy('created_at', 'DESC')
                ->get(),
        ]);
    }
}
