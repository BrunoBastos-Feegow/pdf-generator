<?php

use App\Http\Controllers\SnappyController;
use Illuminate\Support\Facades\Route;

Route::post('test-fixed-content', [SnappyController::class, 'testFixedContent'])->name('snappy.test-fixed-content');

Route::post('basic', [SnappyController::class, 'basic'])->name('snappy.basic');
Route::post('dynamic-report', [SnappyController::class, 'dynamicReport'])->name('snappy.dynamic-report');

