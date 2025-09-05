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
})->where('id', '[0-9]+');

Route::get('/posts/{id}/comments/{commentId}', function (string $id, string $commentId) {
    return 'Post: ' . $id . '<br>' . 'comment: ' . $commentId;
});