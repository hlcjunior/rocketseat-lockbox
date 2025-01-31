<?php

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{
    public function __invoke()
    {
        $notas = Nota::all(request()->get('pesquisar'));

        if (!$notaSelecionada = $this->getNotaSelecionada($notas)) {
            return view('notas/nao-encontrada');
        }

        return view('notas/index', compact('notas', 'notaSelecionada'));
    }

    private function getNotaSelecionada(array $notas)
    {
        $id = request()->get('id', (sizeof($notas) > 0 ? $notas[0]->id : null));

        $filtro = array_filter($notas, fn($n) => $n->id == $id);
        return array_pop($filtro);
    }
}