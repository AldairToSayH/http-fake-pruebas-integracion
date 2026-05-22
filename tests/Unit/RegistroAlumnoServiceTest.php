<?php

namespace Tests\Unit;

use App\Services\PadronAcademicoService;
use App\Services\RegistroAlumnoService;
use Mockery;
use PHPUnit\Framework\TestCase;

class RegistroAlumnoServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_permite_registro_cuando_el_stub_devuelve_true(): void
    {
        $padronStub = Mockery::mock(PadronAcademicoService::class);

        $padronStub->shouldReceive('existeCodigo')
            ->andReturn(true);

        $service = new RegistroAlumnoService($padronStub);

        $resultado = $service->puedeRegistrarse('A001');

        $this->assertTrue($resultado);
    }
}
