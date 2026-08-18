<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [WelcomeController::class, 'index']);

Route::get('/home', function () {
    return view('home', ['name' => "Murat"]);
});

Route::get('/about', function () {
    return view('about');
});
