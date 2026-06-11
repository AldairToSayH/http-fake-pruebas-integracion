<?php

namespace App\Services;

use App\Models\Alumno;
use Illuminate\Support\Facades\Http;

class PadronAcademicoService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.padron.url'), '/');
    }

    public function existeCodigo(string $codigo): bool
    {
        try {
            $response = Http::get("{$this->baseUrl}/api/alumnos/{$codigo}");
        } catch (\Throwable $e) {
            return false;
        }

        return $response->successful();
    }

    public function sincronizar(Alumno $alumno): bool
    {
        $response = Http::post("{$this->baseUrl}/api/alumnos", [
            'codigo' => $alumno->codigo,
            'nombre' => $alumno->nombre,
            'email' => $alumno->email,
        ]);

        return $response->successful();
    }
}
