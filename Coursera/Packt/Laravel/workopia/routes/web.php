<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1>Vacant positions</h1>';
})->name('jobs');

Route::get('/posts/{id}', function (string $id) {
    return 'Post: ' . $id;
});