<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{
    public function __invoke()
    {
        $pesquisar = $_GET['pesquisar'] ?? null;

        $notas = Nota::all($pesquisar);

        $id = $_GET['id'] ?? ($notas[0]?->id ?? 0);
        
        $filtro = array_filter($notas, fn($n) => $n->id == $id);
        $notaSelecionada = array_pop($filtro);

        if(!$notaSelecionada){
            return view('notas/nao-encontrada');
        }

        return view('notas', compact('notas', 'notaSelecionada'));
    }
}