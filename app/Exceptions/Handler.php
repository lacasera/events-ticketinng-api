<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        UnableToVerifyPaymentException::class
    ];

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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if(get_class($exception) === AuthorizationException::class) {
            return response()->json([
                'error' => 'this action is not allowed by user'
            ], 403);
        }

        else if(get_class($exception) === ModelNotFoundException::class) {
            
            $model = strtolower(collect(explode('\\', $exception->getModel()))->last());

            return response()->json([
                'error' => "$model not found"
            ], 404);
        }

        else if(get_class($exception) === NotFoundHttpException::class) {
            return response()->json([
                'error' => 'route not found'
            ], 404);
        } elseif (get_class($exception) === UnableToVerifyPaymentException::class) {
             return response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }
        else  {
            if(app()->environment('production')) {
                return response()->json([
                    'error' => 'something unexpected happened'
                ], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
