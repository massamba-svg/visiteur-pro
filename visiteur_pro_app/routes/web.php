<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/mot-de-passe-oublie', function () {
    return view('forgot-password');
})->name('password.request');

Route::get('/enregistrement-des-visites', function () {
    return view('visits-register');
})->name('visits.register');

Route::get('/clients', function () {
    return view('clients');
})->name('clients.index');

Route::get('/historique-des-visites', function () {
    return view('visits-history');
})->name('visits.history');

Route::get('/gestion-des-roles', function () {
    return view('user-roles');
})->name('roles.index');
