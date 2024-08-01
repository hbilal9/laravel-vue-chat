<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function(){
        Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::post('/login', 'Login');
    });
});

