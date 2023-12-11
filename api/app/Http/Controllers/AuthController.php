<?php

namespace App\Http\Controllers;

use App\Lib\ApiLibrary;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function login(Request $request): JsonResponse {
        return ApiLibrary::layer(function () use ($request) {
            return User::intoAuthenticationResponse(User::login($request));
        });
    }
    
    public function register(Request $request): JsonResponse {
        return ApiLibrary::layer(function () use ($request) {
            return User::intoAuthenticationResponse(User::register($request));
        });
    }

    public function logout(Request $request): JsonResponse {
        $request->user()->tokens()->delete();

        return response()->json([
            'res_type' => 'success',
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request): JsonResponse {
        return response()->json(array_merge([ "res_type" => "user" ], $request->user()->toArray()));
    }
}