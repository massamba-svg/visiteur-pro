<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HelpController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Routes accessibles à tous les utilisateurs authentifiés
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard - Tous les rôles
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Visites - Consultation et ajout pour tous
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');
    Route::get('/visits/create', [VisitController::class, 'create'])->name('visits.create');
    Route::post('/visits', [VisitController::class, 'store'])->name('visits.store');
    Route::get('/visits/{visit}', [VisitController::class, 'show'])->name('visits.show');
    Route::post('/visits/{visit}/end', [VisitController::class, 'endVisit'])->name('visits.end');
    
    // Clients - Consultation pour tous
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    
    // Historique - ORDRE IMPORTANT !
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/export-pdf', [HistoryController::class, 'exportPdf'])->name('history.export-pdf'); // AVANT {visit}
    Route::get('/history/{visit}', [HistoryController::class, 'show'])->name('history.show'); // APRÈS export-pdf
    
    // Paramètres - Tous les rôles
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences');
    
    // Aide - Tous les rôles
    Route::get('/help', [HelpController::class, 'index'])->name('help.index');
});

// Routes pour Administrateur et Gestionnaire
Route::middleware(['auth', 'verified', 'role:Administrateur,Gestionnaire'])->group(function () {
    // Visites - Modification
    Route::get('/visits/{visit}/edit', [VisitController::class, 'edit'])->name('visits.edit');
    Route::put('/visits/{visit}', [VisitController::class, 'update'])->name('visits.update');
    Route::delete('/visits/{visit}', [VisitController::class, 'destroy'])->name('visits.destroy');
    
    // Clients - Création et modification
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    
    // Rapports - Admin et Gestionnaire
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
});

// Routes pour Administrateur uniquement
Route::middleware(['auth', 'verified', 'role:Administrateur'])->group(function () {
    // Gestion des rôles
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::post('/users/{user}/assign-role', [RoleController::class, 'assignRole'])->name('users.assign-role');
    
    // Gestion des utilisateurs
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    
    // Suppression de clients
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});

// Routes pour actions groupées
Route::post('/users/bulk-assign-role', [App\Http\Controllers\UserController::class, 'bulkAssignRole'])->name('users.bulk-assign-role');
Route::delete('/users/bulk-delete', [App\Http\Controllers\UserController::class, 'bulkDelete'])->name('users.bulk-delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
