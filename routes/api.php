<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZipCodeController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->only(['id', 'first_name', 'last_name', 'email']);
});

Route::middleware('auth:sanctum')->get('ping', function () {
    return "pong";
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('user', UserController::class)->only([
        'show',
        'update'
    ]);
    Route::get('/zip-code/{zipCode}', [ZipCodeController::class, 'getByZipCode']);

});