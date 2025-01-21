<?php

namespace App\Controllers\Notas;

use Core\Database;
use Core\Validacao;

class CriarController
{
    public function index()
    {
        return view('notas/criar');
        
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function store()
    {
        $validacao = Validacao::validar([
            'titulo' => ['required', 'min:3', 'max:255'],
            'nota' => ['required']
        ], $_POST);

        if ($validacao->naoPassou()) {
            return view('notas/criar');
        }

        $database = new Database(config('database'));

        $titulo = $_POST['titulo'];
        $nota = $_POST['nota'];

        $database->query(
            'INSERT INTO notas (usuario_id, titulo, nota, data_criacao, data_atualizacao) 
                    VALUES (:usuario_id, :titulo, :nota, :data_criacao, :data_atualizacao)',
            params: [
                'usuario_id' => auth()->id,
                'titulo' => $titulo,
                'nota' => $nota,
                'data_criacao' => date('Y-m-d H:i:s'),
                'data_atualizacao' => date('Y-m-d H:i:s')
            ]
        );

        flash()->push('mensagem', 'Nota inserida com sucesso!');
        return redirect('notas');
    }

}