<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RegistrarAlumnoIntegracionTest extends TestCase {
    use RefreshDatabase;

    public function test_registra_y_sincroniza_un_alumno_aislando_el_servicio_externo(): void
    {
    
        Http::fake([
            'https://padron.test/api/alumnos/A002' => Http::response(['existe' => true], 200),
            'https://padron.test/api/alumnos' => Http::response([
                'message' => 'Alumno sincronizado',
            ], 200),
        ]);
    
     $payload = [
            'codigo' => 'A002',
            'nombre' => 'Carlos Medina',
            'email' => 'carlos@instituto.edu',
        ];
        $response = $this->postJson('/api/alumnos', $payload);

        $response->assertCreated()
            ->assertJson([
                'message' => 'Alumno registrado correctamente',
                'sincronizado' => true,
        ]);

        $this->assertDatabaseHas('alumnos', [
            'codigo' => 'A002',
            'nombre' => 'Carlos Medina',
            'email' => 'carlos@instituto.edu',
            'estado' => 'activo',
        ]);
        
    } 
}