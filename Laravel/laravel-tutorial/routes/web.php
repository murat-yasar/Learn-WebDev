<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('test');
// });


Route::get('test', [TestController::class, 'index']);

// Posts
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id?}', [PostController::class, 'show']);

