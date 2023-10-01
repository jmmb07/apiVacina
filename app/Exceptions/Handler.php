<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ValidationException) {
            return response()->json(
                [
                'errors' => $exception->errors(),
                ]
            )->setStatusCode(422);           
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                [
                'error' => $exception->getMessage(),
                ]
            )->setStatusCode(405);
        }

        return response()->json(
            [
            'error' => $exception->getMessage(),
            ]
        )->setStatusCode(500);
    }

}
