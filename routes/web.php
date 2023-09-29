<?php

use App\Http\Controllers\BrowsershotContoller;
use App\Http\Controllers\PhpwordController;
use App\Http\Controllers\SnappyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('snappy', SnappyController::class);
Route::get('browsershot', BrowsershotContoller::class);
Route::get('phpword', PhpwordController::class);
