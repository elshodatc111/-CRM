<?php

use App\Http\Controllers\web\{AuthController, HomeController, EmploesController};
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {

    // Login sahifasi (Faqat mehmonlar uchun ochiq)
    Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login_post')->middleware('guest');
    
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::middleware(['role:superadmin,direktor,admin'])->prefix('admin')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/empoes', [EmploesController::class, 'index'])->name('emploes_index');
            Route::get('/emploes/{id}', [EmploesController::class, 'show'])->name('emploes_show');
            Route::post('/emploes', [EmploesController::class, 'store'])->name('emploes_store');
        });
        
    });
});