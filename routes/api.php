<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\RepresentativeController;
use Illuminate\Support\Facades\Route;

# Cities (Cidades)
Route::get('/cities', [CitiesController::class, 'index']);
Route::post('/cities', [CitiesController::class, 'store']);
Route::get('/cities/{id}', [CitiesController::class, 'show']);
Route::put('/cities/{id}', [CitiesController::class, 'update']);
Route::delete('/cities/{id}', [CitiesController::class, 'destroy']);

# Clients (Clientes)
Route::get('/clients', [ClientsController::class, 'index']);
Route::post('/clients', [ClientsController::class, 'store']);
Route::get('/clients/{id}', [ClientsController::class, 'show']);
Route::put('/clients/{id}', [ClientsController::class, 'update']);
Route::delete('/clients/{id}', [ClientsController::class, 'destroy']);

# Representatives (Representante)
Route::get('/representatives', [RepresentativeController::class, 'index']);
Route::post('/representatives', [RepresentativeController::class, 'store']);
Route::get('/representatives/{id}', [RepresentativeController::class, 'show']);
Route::put('/representatives/{id}', [RepresentativeController::class, 'update']);
Route::delete('/representatives/{id}', [RepresentativeController::class, 'destroy']);