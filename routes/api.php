<?php

use App\Http\Controllers\Api\AlumnoApiController;
use Illuminate\Support\Facades\Route;

Route::get('/alumnos', [AlumnoApiController::class, 'index']);
Route::post('/alumnos', [AlumnoApiController::class, 'store']);
