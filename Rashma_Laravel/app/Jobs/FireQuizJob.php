<?php

namespace App\Jobs;

use App\Adapter\Sms\NotificationService;
use App\Adapter\Sms\SmsService;
use App\Model\Quiz;
use App\Repositories\Mongo\TokenRepository;
use App\Repositories\Mysql\CategoryProfileRepository;
use App\Repositories\Mysql\ProfileRepository;
use App\Repositories\Mysql\SkillProfileRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FireQuizJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $quiz;

    /**
     * Create a new job instance.
     *
     * @param Quiz $quiz
     */
    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Execute the job.
     *
     * @param SkillProfileRepository $skillProfileRepository
     * @param CategoryProfileRepository $categoryProfileRepository
     * @param ProfileRepository $profileRepository
     * @param NotificationService $notificationService
     * @param TokenRepository $tokenRepository
     * @param SmsService $smsService
     * @return void
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function handle(
        SkillProfileRepository $skillProfileRepository,
        CategoryProfileRepository $categoryProfileRepository,
        ProfileRepository $profileRepository,
        NotificationService $notificationService,
        TokenRepository $tokenRepository,
        SmsService $smsService
    ) {
        $skillProfiles = $skillProfileRepository->getProfilesBySkillIds(collect($this->quiz->skills)->pluck('id')->toArray());
        $categoryProfiles = $categoryProfileRepository->getProfilesByCategoryIds(collect($this->quiz->categories)->pluck('id')->toArray());
        $SkillCategoryProfiles = $skillProfiles->merge($categoryProfiles->toArray());
        $profileIds = $SkillCategoryProfiles->map(function ($SkillCategoryProfile) use ($SkillCategoryProfiles) {
            return collect([
                'profileId' => $SkillCategoryProfile['profileId'],
                'range' => $SkillCategoryProfiles->where('profileId', $SkillCategoryProfile['profileId'])->sum('range')
            ]);
        })->unique('profileId')->sortBy('range')->pluck('profileId')->toArray();

        $this->sendNotify($profileIds, $profileRepository, $notificationService, $tokenRepository, $smsService);
    }

    /**
     * @param null $exception
     */
    public function fail($exception = null)
    {
        if ($this->attempts() < 3) {
            Log::error('Fire Quiz Job Failed');
            $this->release($this->attempts() * 60);
        }
        Log::error('Fire Quiz Job Failed');
    }

    /**
     * @param array $profileIds
     * @param ProfileRepository $profileRepository
     * @param NotificationService $notificationService
     * @param TokenRepository $tokenRepository
     * @param SmsService $smsService
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    private function sendNotify(
        array $profileIds,
        ProfileRepository $profileRepository,
        NotificationService $notificationService,
        TokenRepository $tokenRepository,
        SmsService $smsService
    ) {
        foreach ($profileIds as $profileId) {

            if ($notifyToken = $tokenRepository->getByProfileId($profileId)->get('notify')) {
                $notificationService->offerQuiz($notifyToken, $this->quiz);
            } else {
                $phone = $profileRepository->get($profileId)->user->phone;
                $smsService->offerQuiz($phone, $this->quiz);
            };
        }
    }
}
