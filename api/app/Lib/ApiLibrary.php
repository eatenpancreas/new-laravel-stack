<?php

namespace App\Lib;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class ApiLibrary {
    static function layer(\Closure $closure): JsonResponse {
        try {
            return $closure();
        } catch (QueryException $e) {
            $message = $e->getMessage();    
            if (str_contains($message, "Unknown database")) {
                return ApiLibrary::headError("The database could not be found, or failed to connect.");
            }
            return ApiLibrary::headError($message);
        }
    }
    
    static function headError(string $message, int $code = 500): JsonResponse {
        return response()->json([
            'res_type' => 'head_error',
            'error' => $message,
        ], $code);
    }
    
    static function defaultResponder(string $status = "running", int $code = 200): \Closure {
        return function () use ($status, $code) {
            return response()->json(([
                'res_type' => 'status',
                'status' => $status
            ]), $code);
        };
    }
}