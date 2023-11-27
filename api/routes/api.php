<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Lib\ApiLibrary;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', ApiLibrary::defaultResponder());


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
