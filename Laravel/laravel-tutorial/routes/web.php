<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('test');
// });


Route::get('test', [TestController::class, 'index']);

Route::get('posts', [PostController::class, 'getPosts']);

