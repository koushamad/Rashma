<?php


namespace App\Http\Controllers\Api;


use App\Services\QuizService;
use Illuminate\Http\Request;

class TestController extends ApiController
{
    /**
     * ApiController constructor.
     * @param QuizService $service
     * @param Request $request
     */
    public function __construct(QuizService $service, Request $request)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * @group Test
     */
    public function test(){

    }
}
