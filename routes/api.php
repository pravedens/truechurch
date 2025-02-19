<?php

use App\Http\Controllers\API\AuthApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\ConferenceApiController;
use App\Http\Controllers\API\GroupApiController;
use App\Http\Controllers\API\HomeApiController;
use App\Http\Controllers\API\PostApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return new UserResource($request->user());
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('users', UserApiController::class, array('as' => 'api'));
    Route::post('logout', [AuthApiController::class, 'logout']);
});

Route::post('register', [AuthApiController::class, 'register']);

Route::post('login', [AuthApiController::class, 'login']);

Route::get('categories', [CategoryApiController::class, 'index']);

Route::get('groups', [GroupApiController::class, 'index']);

Route::get('conferences', [ConferenceApiController::class, 'index']);

Route::get('posts', [PostApiController::class, 'index']);

Route::get('homes', [HomeApiController::class, 'index']);
