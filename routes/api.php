<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


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

Route::prefix('/v1')->group(function(){
    Route::get('/csrf', function() {
      return Session::token();
    });

    Route::prefix('friend')->group(function(){
        Route::post('get-friends', [FriendsController::class, 'getFriends']);
    });

    Route::prefix('user')->group(function(){
        Route::get('{id}', [UserController::class, 'getUser']);
        Route::post('/create-user', [UserController::class, 'registerUser']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/check-old-password', [UserController::class, 'checkOldPassword']);
        Route::post('/auto-login', [UserController::class, 'autoLogin']);
    });
});

