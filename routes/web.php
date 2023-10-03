<?php //routes/web.php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\BrowsershotContoller;
use App\Http\Controllers\LetterheadController;
use App\Http\Controllers\PhpwordController;
use App\Http\Controllers\SnappyController;

//salvar os dados do vuejs na session para testes rápidos
Route::middleware('web')->post('/save-configs', function (Request $request){
    session()->remove('configs');
    $request->session()->put('configs', $request->all());
    return response()->json(['status' => 'success']);
})->name('save-configs');


Route::get('snappy', SnappyController::class);
Route::get('browsershot', BrowsershotContoller::class);
Route::get('phpword', PhpwordController::class);
Route::get('letterhead', LetterheadController::class);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
