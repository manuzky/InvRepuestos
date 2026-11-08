<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\RolController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    Route::resource('usuarios', UsuarioController::class)->except(['show', 'destroy']);

    Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'toggleStatus'])->name('usuarios.toggle-status');

    Route::resource('cargos', CargoController::class)->except(['show']);
    Route::patch('/cargos/{cargo}/estado', [CargoController::class, 'toggleStatus'])->name('cargos.toggle-status');

    Route::resource('roles', RolController::class)->except(['show']);

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});