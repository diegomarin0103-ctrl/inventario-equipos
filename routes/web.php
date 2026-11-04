<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');

Route::resource('categorias', CategoriaController::class);
Route::resource('equipos', EquipoController::class);
