<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AlumnoPageController extends Controller
{
        public function index(): View
        {
        return view('alumnos.index');
        }
        public function create(): View
        {
        return view('alumnos.create');
    }
}
