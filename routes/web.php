<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    // -------------------------------------------- Menú principal --------------------------------------------
    Route::get('/', function () {
        return view('inicio');
    })->name('inicio');

    // -------------------------------------------- Inventario --------------------------------------------
    Route::resource('productos', ProductoController::class)->except(['show'])->parameters(['productos' => 'producto']);
    Route::patch('/productos/{producto}/estado', [ProductoController::class, 'toggleStatus'])->name('productos.toggle-status');

    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::patch('/categorias/{categoria}/estado', [CategoriaController::class, 'toggleStatus'])->name('categorias.toggle-status');

    Route::resource('marcas', MarcaController::class)->except(['show']);
    Route::patch('/marcas/{marca}/estado', [MarcaController::class, 'toggleStatus'])->name('marcas.toggle-status');

    Route::resource('proveedores', ProveedorController::class)->except(['show'])->parameters(['proveedores' => 'proveedor']);
    Route::patch('/proveedores/{proveedor}/estado', [ProveedorController::class, 'toggleStatus'])->name('proveedores.toggle-status');

    // -------------------------------------------- Operaciones --------------------------------------------
    Route::resource('clientes', ClienteController::class)->except(['show'])->parameters(['clientes' => 'cliente']);
    Route::patch('/clientes/{cliente}/estado', [ClienteController::class, 'toggleStatus'])->name('clientes.toggle-status');

    // -------------------------------------------- Administración --------------------------------------------
    Route::resource('usuarios', UsuarioController::class)->except(['show', 'destroy']);
    Route::patch('/usuarios/{usuario}/estado', [UsuarioController::class, 'toggleStatus'])->name('usuarios.toggle-status');

    Route::resource('cargos', CargoController::class)->except(['show']);
    Route::patch('/cargos/{cargo}/estado', [CargoController::class, 'toggleStatus'])->name('cargos.toggle-status');

    Route::resource('roles', RolController::class)->except(['show']);

    // -------------------------------------------- Sistema --------------------------------------------
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});