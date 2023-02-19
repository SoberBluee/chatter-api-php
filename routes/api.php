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
        Route::get('{email}', [UserController::class, 'getUser']);
        Route::post('/create-user', [UserController::class, 'registerUser']);
        Route::post('/login', [UserController::class, 'login']);
        Route::post('/check-old-password', [UserController::class, 'checkOldPassword']);
    });

    // Route::prefix('posts')->group(function(){
    //     Route::get('get-all-posts', [PostsController::class,'getAllPosts']);
    //     Route::post('create-post', [PostsController::class, 'setPost']);
    //     Route::get('{post_id}', [PostsController::class, 'getPost']);
    //     Route::delete('{post_id}', [PostsController::class, 'deletePost']);
    //     Route::post('/edit', [PostsController::class, 'editPost']);
    // });

    // Route::prefix('messages')


});

