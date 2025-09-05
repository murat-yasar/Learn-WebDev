<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1>Vacant positions</h1>';
});

Route::match(['get', 'post'], '/submit', function () {
    return 'Form submitted';
});