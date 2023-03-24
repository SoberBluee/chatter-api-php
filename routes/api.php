<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\EmailController;
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

Route::prefix('v1')->group(function(){

    // Route::prefix('email')->groupo(function(){
    //     Route::get('reset-password', [EmailController::class, 'confirmChangePassword']);
    // });

    Route::get('csrf', function() {
      return Session::token();
    });

    Route::prefix('friend')->group(function(){
        Route::post('get-friends', [FriendsController::class, 'getFriends']);
    });

    Route::prefix('user')->group(function(){
        Route::get('{id}', [UserController::class, 'getUser']);
        Route::post('create-user', [UserController::class, 'registerUser']);
        Route::post('login', [UserController::class, 'login']);
    });

    Route::prefix('account')->group(function(){
        Route::post('check-old-password', [AccountController::class, 'checkOldPassword']);
        Route::post('update-password', [AccountController::class, 'updatePassword']);
        Route::post('update-account-details', [AccountController::class, 'updateAccountDetails']);
        Route::post('update-email', [AccountController::class, 'updateEmail']);
    });

    Route::prefix('mail')->group(function(){
        Route::get("email-change-email", [EmailController::class, 'emailChangePassword']);
    });
});

