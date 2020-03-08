<?php

namespace App\Http\Controllers\Api;

use App\Services\WalletService;
use Illuminate\Http\Request;

class WalletController extends ApiController
{
    /** @var WalletService */
    protected $service;

    /**
     * WalletController constructor.
     * @param WalletService $service
     * @param Request $request
     */
    public function __construct(WalletService $service, Request $request)
    {
        parent::__construct($service, $request);
    }

    /**
     * Get Statistics
     * @group Wallet
     * @return \Illuminate\Http\JsonResponse
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function getStatistics(){
        return $this->success($this->service->getStatistics($this->request->get('profileId'))->toArray());
    }
}
