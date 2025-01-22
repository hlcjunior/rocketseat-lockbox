<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{
    public function __invoke()
    {
        $notas = Nota::all();

        $id = isset($_GET['id']) ?? $notas[0]->id;
        
        $filtro = array_filter($notas, fn($n) => $n->id == $id);
        $notaSelecionada = array_pop($filtro);
        return view('notas', compact('notas', 'notaSelecionada'));
    }
}