<?php

namespace App\Services;

class RegistroAlumnoService
{
    public function __construct(
        protected PadronAcademicoService $padron
    ) {
    }

    public function puedeRegistrarse(string $codigo): bool
    {
        return $this->padron->existeCodigo($codigo);
    }
}
