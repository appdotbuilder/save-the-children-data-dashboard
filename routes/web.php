<?php

use App\Http\Controllers\ComparisonDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataEntryController;
use App\Http\Controllers\InvestmentDashboardController;
use App\Http\Controllers\MunicipalityDashboardController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dashboard analytics routes
    Route::prefix('dashboards')->name('dashboards.')->group(function () {
        Route::get('/municipality/{municipality?}', [MunicipalityDashboardController::class, 'index'])->name('municipality');
        Route::get('/comparison', [ComparisonDashboardController::class, 'index'])->name('comparison');
        Route::get('/investments', [InvestmentDashboardController::class, 'index'])->name('investments');
    });
    
    // Data entry routes
    Route::resource('data-entries', DataEntryController::class);
    
    // Admin routes
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('tags', TagController::class);
        // Additional admin routes will be added here
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';