<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Visits
    Route::resource('visits', VisitController::class);
    Route::post('/visits/{visit}/end', [VisitController::class, 'endVisit'])->name('visits.end');
    
    // Clients
    Route::resource('clients', ClientController::class);
    
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
    // Roles
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::post('/users/{user}/assign-role', [RoleController::class, 'assignRole'])->name('users.assign-role');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
