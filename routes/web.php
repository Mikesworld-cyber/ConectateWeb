<?php

use App\Http\Controllers\ApiClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\generarreporte;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Muestra directamente la vista 'layouts.dashboard'
// La ruta 'layouts.dashboard' se traduce a: resources/views/layouts/dashboard.blade.php


Route::get('/dashboard/inicio', [ApiClienteController::class, 'index'])->name('dashboard');

// Ruta dinámica para peticiones AJAX u otras (manténla al final para no sobreescribir rutas específicas)
Route::get('/dashboard/{request}', [ApiClienteController::class, 'getTablaData'])->name('contratos.index');




// Route::get('/d', function () {
//     return view('prueba');
// });

// Route::get('/api/get-table-data', [ApiClienteController::class, 'getTablaData'])->name('api.data');

// 1. Ruta que el formulario USA en la acción
Route::post('/contratos', [ContratoController::class, 'store'])->name('contratos.store'); // ⬅️ ¡Esta es la ruta POST!
Route::get('/generar-pdf/{id}', [generarreporte::class, 'showContrato']);

Route::get('/google/auth', [GoogleDriveController::class, 'redirectToGoogle'])->name('google.auth');
Route::get('/oauth2callback', [GoogleDriveController::class, 'handleCallback']);
Route::post('/drive/upload', [GoogleDriveController::class, 'upload2'])->name('drive.upload');