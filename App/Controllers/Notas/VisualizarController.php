<?php

namespace App\Controllers\Notas;

use Core\Validacao;

class VisualizarController
{

    public function confirmar()
    {
        return view('notas/confirmar');
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function mostrar()
    {
        $validacao = Validacao::validar([
            'senha' => ['required']
        ], request()->all());

        if ($validacao->naoPassou()) {
            return view('notas/confirmar');
        }

        if (!password_verify(request()->post('senha'), auth()->senha)) {
            flash()->push('validacoes', ['senha' => ['Senha incorreta!']]);
            return view('notas/confirmar');
        }

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