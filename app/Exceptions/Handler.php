<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->renderable(function (Throwable $e) {

            $message = "Ocurrió un error interno en el servidor.";
            $code = 500;

            if ($e->getCode()) {
                $code = $e->getCode();
            }
            if ($e->getMessage()) {
                $message = $e->getMessage();
            }

            return response()->json([
                'message' => $message,
                'code' => $code
            ], $code);
        });
    }
}
