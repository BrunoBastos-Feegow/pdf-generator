<?php

use App\Http\Controllers\BrowsershotContoller;
use App\Http\Controllers\PhpwordController;
use App\Http\Controllers\WkhtmltopdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('wkhtmltopdf', WkhtmltopdfController::class);
Route::get('browsershot', BrowsershotContoller::class);
Route::get('phpword', PhpwordController::class);
