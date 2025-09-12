<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
// use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', [JobController::class, 'index']);

Route::get('/jobs/create', [JobController::class, 'create']);

// Route::get('/test', function (Request $request) {
//     return [
//         'method' => $request->method(),
//         'url' => $request->url(),
//         'fullUrl' => $request->fullUrl(),
//         'path' => $request->path(),
//         'ip' => $request->ip(),
//         'userAgent' => $request->userAgent(),
//         'header' => $request->header(),
//     ];
// });


//* Request Object */

// Route::get('/users', function (Request $request) {
//     return $request->query('name');
// });

// Route::get('/users', function (Request $request) {
//     return $request->only(['name', 'age']);
// });

// Route::get('/users', function (Request $request) {
//     return $request->all([]);
// });

// Route::get('/users', function (Request $request) {
//     return $request->has('name');
// });

// Route::get('/users', function (Request $request) {
//     return $request->input('birth');
// });

// Route::get('/users', function (Request $request) {
//     return $request->except('age');
// });


//* Response Object */

// Route::get('/test', function () {
//     return response('Hello World!', 200);
// });

// Route::get('/test', function () {
//     return response('<h1>Hello World!</h1>', 200)->header('Content-Type', 'text/plain');
// });

// Route::get('/test', function () {
//     return response('<h1>Hello World!</h1>', 200)->header('Content-Type', 'html');
// });

// Route::get('/notfound', function () {
//     return response('<h1>Not Found</h1>', 404);
// });

// Route::get('/test', function () {
//     return response()->json(['name' => 'John Doe']);
// });

// Route::get('/download', function () {
//     return response()->download(public_path('favicon.ico'));
// });

// Route::get('/test', function () {
//     return response()->json()->cookie('name', 'Murat Yaşar');
// });

// Route::get('/cookie', function (Request $request) {
//     $cookieValue = $request->cookie('name');
//     return response()->json(['cookie' => $cookieValue]);
// });