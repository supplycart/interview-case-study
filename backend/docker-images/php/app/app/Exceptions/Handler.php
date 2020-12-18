<?php

namespace App\Exceptions;


use Throwable;
use App\Libraries\Common;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable  $exception
     * @return mixed
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
	    if (env('APP_DEBUG')) {
		    return parent::render($request, $exception);
	    }
	    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
	    if ($exception instanceof HttpResponseException) {
		    $status = Response::HTTP_INTERNAL_SERVER_ERROR;
	    } elseif ($exception instanceof MethodNotAllowedHttpException) {
		    $status = Response::HTTP_METHOD_NOT_ALLOWED;
		    $e = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $exception);
	    } elseif ($exception instanceof NotFoundHttpException) {
		    $status = Response::HTTP_NOT_FOUND;
		    $e = new NotFoundHttpException('HTTP_NOT_FOUND', $exception);
	    } elseif ($exception instanceof AuthorizationException) {
		    $status = Response::HTTP_FORBIDDEN;
		    $e = new AuthorizationException('HTTP_FORBIDDEN', $status);
	    } elseif ($exception instanceof \Dotenv\Exception\ValidationException && $exception->getResponse()) {
		    $status = Response::HTTP_BAD_REQUEST;
		    $e = new \Dotenv\Exception\ValidationException('HTTP_BAD_REQUEST', $status, $exception);
	    } elseif ($exception) {
		    $e = new HttpException($status, 'HTTP_INTERNAL_SERVER_ERROR');
	    }
	    $response = Common::formatResponse(['message' => $e->getMessage()], $status);
	    return response()->json($response);
    }
}
