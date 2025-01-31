<?php

namespace App\Controllers\Notas;

use App\Models\Nota;
use Core\Database;
use Core\Validacao;
use JetBrains\PhpStorm\NoReturn;

class DeleteController
{
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    #[NoReturn] public function __invoke()
    {

        $validacao = Validacao::validar([
            'id' => ['required']

        ], request()->all());

        if ($validacao->naoPassou()) {
            return redirect('notas?id=' . request()->post('id'));
        }

        Nota::delete(request()->post('id'));

        flash()->push('mensagem', 'Nota excluída com sucesso!');

        return redirect('notas');
    }
}