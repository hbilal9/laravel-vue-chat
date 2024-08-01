<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function(){
        Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::post('/login', 'Login');
        Route::post('/register', 'Register');
    });
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function(){
        Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::get('/me', 'getProfile');
    });
});

Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function(){
    Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
        Route::get('/search', 'search');
        Route::resource('/conversations', \App\Http\Controllers\ConversationController::class);
        Route::get('/conversations/{conversation}/messages', [ \App\Http\Controllers\MessageController::class, 'index']);
        Route::post('/conversations/{conversation}/messages', [ \App\Http\Controllers\MessageController::class, 'store']);
        Route::get('/messages/{message}/mark-seen', [ \App\Http\Controllers\MessageController::class, 'markAsSeen']);
    });
});

