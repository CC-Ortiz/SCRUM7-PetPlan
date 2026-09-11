<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index');
});

Route::get('/registro', function () {
    return view('registro');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/citas', function () {
    return view('citas');
});

Route::get('/historial', function () {
    return view('historial');
});

Route::get('/mascotas', function () {
    return view('mascotas');
});

Route::get('/agendar-citas', function () {
    return view('agendar-citas');
});