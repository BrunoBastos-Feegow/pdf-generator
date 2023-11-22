<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['medicalRecords']
], function() {
    Route::post('/html-to-pdf', [\App\Http\Controllers\SnappyController::class, 'basicHtmlToPdf'])
        ->name('html-to-pdf');
});

