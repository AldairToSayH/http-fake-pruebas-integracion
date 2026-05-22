<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'email',
        'estado',
    ];
}
