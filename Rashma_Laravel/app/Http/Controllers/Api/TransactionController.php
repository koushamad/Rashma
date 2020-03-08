<?php

namespace App\Http\Controllers\Api;

use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{
    /** @var TransactionService */
    protected $service;

    public function __construct(TransactionService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Cash In
     * @group Transaction
     * @bodyParam cash float required
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function cashIn()
    {
        $this->validate($this->request, ['cash' => 'numeric|min:0',]);
        return $this->success($this->service->cashInRequest(
            $this->request->userId,
            $this->request->profileId,
            $this->request->get('cash')
        )->toArray());
    }

    /**
     * Cash In Approve
     * @group Transaction
     * @bodyParam callbackKey string required
     * @return JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     */
    public function cashInApprove()
    {
        return $this->success(['success' => $this->service->approveCashIn($this->request->get('callbackKey'))]);
    }

    /**
     * Cash Out Approve
     * @group Transaction
     * @bodyParam cash float required
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function cashOut()
    {
        return $this->success([
            'success' => $this->service->cashOutRequest($this->request->get('cash'), $this->request->userId,
                $this->request->profileId)
        ]);
    }

    /**
     * Cash Out Approve
     * @group Transaction
     * @bodyParam code string required
     * @throws \Facade\FlareClient\Http\Exceptions\BadResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function cashOutApprove(): JsonResponse
    {
        return $this->success([

            'success' => $this->service->cashOutApprove($this->request->get('code'),
                $this->request->userId,
                $this->request->profileId)
        ]);
    }
}
