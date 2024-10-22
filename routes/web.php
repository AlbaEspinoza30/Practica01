<?php

use App\Http\Controllers\EntradaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resource('entradas', EntradaController::class);

