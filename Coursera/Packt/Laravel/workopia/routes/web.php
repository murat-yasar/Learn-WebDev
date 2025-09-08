<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1>Vacant positions</h1>';
})->name('jobs');

Route::get('/test', function (Request $request) {
    return [
        'method' => $request->method(),
        'url' => $request->url(),
        'fullUrl' => $request->fullUrl(),
        'path' => $request->path(),
        'ip' => $request->ip(),
        'userAgent' => $request->userAgent(),
        'header' => $request->header(),
    ];
});


// Route::get('/users', function (Request $request) {
//     return $request->query('name');
// });

// Route::get('/users', function (Request $request) {
//     return $request->only(['name', 'age']);
// });

Route::get('/users', function (Request $request) {
    return $request->all([]);
});

// Route::get('/users', function (Request $request) {
//     return $request->has('name');
// });

// Route::get('/users', function (Request $request) {
//     return $request->input('birth');
// });

// Route::get('/users', function (Request $request) {
//     return $request->except('age');
// });