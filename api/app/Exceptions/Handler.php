<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    protected function invalidJson($request, ValidationException $exception): \Illuminate\Http\JsonResponse
    {
        $errors = [];
        foreach ($exception->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'code' => $field,
                    'message' => $message,
                ];
            }
        }
        
        $message = $errors[0]['message'] . " (and " . count($errors) - 1 . " other error" . (count($errors) > 2 ? "s" : "") . " occurred.)";

        return response()->json([
            'res_type' => 'validation_error',
            'message' => $message,
            'error' => $errors,
        ], $exception->status);
    }
}
