<?php

namespace App\Exceptions;

use App\Http\Controllers\Api\Traits\ApiResponse;
use Exception;
use Facade\FlareClient\Http\Exceptions\MissingParameter;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    protected $request = null;


    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)){
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    public function render($request, Exception $exception)
    {
        $this->request = $request;
        if ($request->expectsJson()) {
            if ($exception instanceof NotFound) {
                return $this->addMessage($exception->getMessage())->notFound();
            }

            if ($exception instanceof ValidationException) {
                return $this->addMessage($exception->getMessage())->badRequest();
            }

            if ($exception instanceof AccessDeniedException) {
                return $this->addMessage($exception->getMessage())->forbidden();
            }

            if ($exception instanceof MissingParameter) {
                return $this->addMessage($exception->getMessage())->internalServer();
            }

            if ($exception instanceof AuthenticationException) {
                return $this->addMessage(trans('error.unauthenticated'))->unAuthenticate();
            }

            if ($exception instanceof Exception) {
                return $this->addMessage($exception->getMessage())->slackException($exception)->internalServer();
            }
        }
        dd($exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     * @param Request $request
     * @param AuthenticationException $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->addMessage(trans('error.unauthenticated'))->unAuthenticate();
        }

        return redirect()->guest('login');
    }

    function getRequest(): ?Request
    {
        return $this->request;
    }
}
