<?php

namespace App\Services;

use App\Repositories\Mysql\CreditCardRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;

class CreditCardService extends BaseService
{
    /** @var CreditCardRepository */
    protected $repository;

    public function __construct(CreditCardRepository $creditCardRepository)
    {
        parent::__construct($creditCardRepository);
    }

    /**
     * @param int $walletId
     * @return Collection
     * @throws NotFound
     */
    public function getByWalletId(int $walletId): Collection
    {
        return collect($this->repository->getByWalletId($walletId));
    }

    /**
     * @param int $walletId
     * @param string $creditCardNumber
     * @throws \Facade\FlareClient\Http\Exceptions\MissingParameter
     */
    public function addCard(int $walletId, string $creditCardNumber): void
    {
        if (!is_null($creditCardNumber)) {
            try {
                $creditCard = $this->repository->getByWalletId($walletId);
                if ($creditCard->cardNumber !== $creditCardNumber) {
                    $this->repository->delete($creditCard->id);
                    $this->repository->create(['walletId' => $walletId, 'cardNumber' => $creditCardNumber]);
                }
            } catch (NotFound $exception) {
                $this->repository->create(['walletId' => $walletId, 'cardNumber' => $creditCardNumber]);
            }
        }
    }
}
