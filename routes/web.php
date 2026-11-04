<?php

use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/equipos')->name('inicio');

Route::resource('equipos', EquipoController::class);
