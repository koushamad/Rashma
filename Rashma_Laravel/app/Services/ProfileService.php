<?php

namespace App\Services;

use App\Model\User;
use App\Repositories\Mysql\ProfileRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProfileService extends BaseService
{
    /** @var ProfileRepository */
    protected $repository;

    /** @var SkillService */
    protected $skillService;

    /** @var CategoryService */
    protected $categoryService;

    /** @var CreditCardService */
    protected $creditCardService;

    /** @var WalletService */
    protected $walletService;

    /**
     * SettingService constructor.
     * @param ProfileRepository $profileRepository
     * @param SkillService $skillService
     * @param CategoryService $categoryService
     * @param CreditCardService $creditCardService
     * @param WalletService $walletService
     */
    public function __construct(
        ProfileRepository $profileRepository,
        SkillService $skillService,
        CategoryService $categoryService,
        CreditCardService $creditCardService,
        WalletService $walletService
    ) {
        parent::__construct($profileRepository);
        $this->skillService = $skillService;
        $this->categoryService = $categoryService;
        $this->creditCardService = $creditCardService;
        $this->walletService = $walletService;
    }

    /**
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getProfileByUser(): Collection
    {
        /** @var User $user */
        $user = Auth::user();

        return collect($this->repository->getByUserId($user->id));
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function createDefaultProfile(int $userId): Collection
    {
        return collect(
            $this->repository->create(
                [
                    'userId' => $userId,
                ]
            )
        );
    }

    /**
     * @param array $attributes
     * @return Collection
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function updateProfile(array $attributes): Collection
    {
        /** @var User $user */
        $user = Auth::user();
        $attributes = collect($attributes);

        $this->repository->updateByUserId(
            $user->id,
            $attributes->only(['fullName', 'imageId', 'nationalCode'])->toArray()
        );
        $this->repository->syncSkills($user->id, $this->skillService->add($attributes->get('skills')));
        $this->repository->syncCategories($user->id, $this->categoryService->add($attributes->get('categories')));
        if($attributes->has('cardNumber') && $attributes->get('cardNumber')){
            $this->creditCardService->addCard(
                $this->walletService->getWalletByProfileId($this->repository->getByUserId($user->id)->id)->get('id'),
                $attributes->get('cardNumber')
            );
        }

        return $this->getProfileByUser();
    }


    /**
     * @param array $attributes
     * @return bool
     * @throws NotFound
     */
    public function attachProfile(array $attributes): bool
    {
        /** @var User $user */
        $user = Auth::user();
        $attributes = collect($attributes);

        return $this->repository->updateByUserId(
            $user->id,
            $attributes->toArray()
        );
    }

    /**
     * @param int $profileId
     * @return Collection
     * @throws NotFound
     */
    public function getSkillsRange(int $profileId): Collection{
        return collect($this->repository->get($profileId)->ProfileSkills)->map(function ($profileSkill){
            return collect(['name' => $profileSkill->skill->name, 'range' => $profileSkill->range]);
        });
    }

    public function getEnums($profileId = null)
    {
        $user = $profileId === null ? Auth::user() : $this->repository->get($profileId)->user;

        return collect([
            "account" => config('rashma.account')[substr($user->phone,1,2)] ?? config('rashma.code')['00'],
            "licenceGrade" => config('rashma.licenceGrade'),
            "experienceGrade" => config('rashma.experienceGrade'),
        ]);
    }

}
