<?php

namespace App\Controllers\Notas;

class VisualizarController
{
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function mostrar()
    {
        session()->set('mostrar', true);
        return redirect('notas');
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function esconder()
    {
        session()->forget('mostrar');
        return redirect('notas');
    }

}