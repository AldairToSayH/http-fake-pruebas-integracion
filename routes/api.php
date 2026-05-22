<?php

use App\Http\Controllers\Api\AlumnoController;
use Illuminate\Support\Facades\Route;

Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::post('/alumnos', [AlumnoController::class, 'store']);