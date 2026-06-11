<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrarAlumnoDuskTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_usuario_registra_un_alumno_desde_una_interfaz_que_consume_la_api(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/alumnos/crear')
                ->press('@btn-guardar')
                ->waitForText('Debe ingresar el código del alumno.')
                ->assertPathIs('/alumnos/crear')
                ->assertSee('Debe ingresar el código del alumno.')
                ->assertSee('Debe ingresar el nombre del alumno.')
                ->assertSee('Debe ingresar el correo del alumno.');
        });
    }
}
