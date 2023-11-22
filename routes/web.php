<?php //routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('letterhead/{id?}', [\App\Http\Controllers\LetterheadController::class, 'index'])->name('letterhead');
Route::post('letterhead', [\App\Http\Controllers\LetterheadController::class, 'save'])->name('letterhead.save');

Route::get('snappy', [\App\Http\Controllers\SnappyController::class, 'testeFixedContent'])->name('snappy.teste');

Route::get('browsershot', \App\Http\Controllers\BrowsershotContoller::class);

Route::get('/', function() {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
