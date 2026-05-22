<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Services\PadronAcademicoService;
use App\Services\RegistroAlumnoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function __construct(
        protected PadronAcademicoService $padron,
        protected RegistroAlumnoService $registro
    ) {}

    public function index(): JsonResponse
    {
        $alumnos = Alumno::all();

        return response()->json([
            'message' => 'Listado de alumnos',
            'data' => $alumnos,
            'total' => $alumnos->count(),
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'codigo' => ['required', 'string', 'unique:alumnos,codigo'],
                'nombre' => ['required', 'string', 'min:5', 'max:100'],
                'email' => ['required', 'email', 'unique:alumnos,email'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \App\Helpers\ApiResponse::validationError(
                'Validation failed.',
                $e->errors()
            );
        }

        if (! $this->registro->puedeRegistrarse($validated['codigo'])) {
            return \App\Helpers\ApiResponse::error(
                422,
                'CODIGO_NO_VALIDO',
                'El código no está autorizado en el padrón académico.',
                "El código {$validated['codigo']} no existe en el padrón externo.",
                'Verifique el código con el departamento académico.'
            );
        }

        $alumno = Alumno::create($validated)->refresh();

        try {
            $sincronizado = $this->padron->sincronizar($alumno);
        } catch (\Exception $e) {
            $sincronizado = false;
        }

        return response()->json([
            'message' => 'Alumno registrado correctamente',
            'data' => $alumno,
            'sincronizado' => $sincronizado,
        ], 201);
    }
}
