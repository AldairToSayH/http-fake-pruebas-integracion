<?php

use App\Http\Controllers\AlumnoPageController;
use Illuminate\Support\Facades\Route;

Route::get('/alumnos', [AlumnoPageController::class, 'index'])
    ->name('alumnos.index');

Route::get('/alumnos/crear', [AlumnoPageController::class, 'create'])
    ->name('alumnos.create');

Route::view('/alumnos-ui', 'alumnos.ui')
    ->name('alumnos.ui');
