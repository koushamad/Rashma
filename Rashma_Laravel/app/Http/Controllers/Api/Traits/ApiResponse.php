<?php

namespace App\Http\Controllers\Api\Traits;

use App\Enums\ApiEnums;
use App\Notifications\AlertNotify;
use App\Notifications\DebugNotify;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

trait ApiResponse
{
    protected $code;
    protected $status;
    protected $messages;
    protected $data;

    private function getResponse()
    {
        return [
            "status" => $this->status,
            "code" => $this->code,
            "messages" => $this->messages,
            "data" => $this->data
        ];
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function success(array $data): JsonResponse
    {
        $this->status = true;
        $this->code = Response::HTTP_OK;
        $this->data = $data;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function badRequest(): JsonResponse
    {
        $this->status = false;
        $this->code = Response::HTTP_BAD_REQUEST;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function notFound(): JsonResponse
    {
        $this->status = false;
        $this->code = Response::HTTP_NOT_FOUND;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function forbidden(): JsonResponse
    {
        $this->status = false;
        $this->code = Response::HTTP_FORBIDDEN;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function internalServer(): JsonResponse
    {
        $this->status = false;
        $this->code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function unAuthenticate()
    {
        $this->status = false;
        $this->code = Response::HTTP_UNAUTHORIZED;
        $this->debugRequest();
        return response()->json($this->getResponse(), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param string $message
     * @param string $type
     * @return self
     */
    public function addMessage(string $message, string $type = ApiEnums::ERROR_MESSAGE): self
    {
        $this->messages[] = ["text" => $message, 'type' => $type];
        return $this;
    }

    /**
     * @return Request|null
     */
    abstract function getRequest(): ?Request;

    /**
     * @param Exception $exception
     * @return $this
     */
    protected function slackException(Exception $exception)
    {
        Log::warning($exception);
        Notification::route('slack', config('slack.exception'))->notify(new AlertNotify($exception));
        return $this;
    }

    protected function debugRequest()
    {
        $request = $this->getRequest();
        if (env('APP_DEBUG') && $request->get('debug', false)) {
            Notification::route('slack', config('slack.request'))->notify(new DebugNotify($request, $this->getResponse()));
        }
    }
}
