<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $request;

    /**
     * Create a new controller instance.
     * @param Request $request
     * @param TransactionService $transactionService
     */
    public function __construct(Request $request, TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function cashIn()
    {
        $callbackKey = $this->request->get('callbackKey');
        $transaction = $this->transactionService->redirectCashIn($callbackKey);

        return view('cashIn')->with($transaction->toArray());
    }

    /**
     * Show the application dashboard.
     * @return void
     * @throws \Facade\FlareClient\Http\Exceptions\NotFound
     */
    public function cashInApprove()
    {
        if ($this->request->get('action') == trans('btn.approve')) {
            $callbackKey = $this->request->get('callbackKey');
            $trackNumber = $this->request->get('trackNumber');
            $this->transactionService->approveCashIn($callbackKey, $trackNumber);
        }

        return redirect(route('welcome'));
    }
}
