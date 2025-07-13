<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# Cities (Cidades)
Route::view('/cities', 'cities');

# Clients (Clientes)
Route::view('/clients', 'clients');

# Representatives (Representantes)
Route::view('/representatives', 'representative');