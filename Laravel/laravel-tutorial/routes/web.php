<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

// TEST
Route::get('test', [TestController::class, 'index']);

// POSTS
Route::get('posts', [PostController::class, 'index']);

Route::get('posts/create', [PostController::class, 'create']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{id}', [PostController::class, 'show']);

Route::get('edit_post/{id}', [PostController::class, 'edit']);
Route::post('update_post/{id}', [PostController::class, 'update']);

Route::get('delete_post/{id}', [PostController::class, 'delete']);

// AUTHENTICATION
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('login', [AuthController::class, 'login_form']);
Route::get('register', [AuthController::class, 'register_form']);
