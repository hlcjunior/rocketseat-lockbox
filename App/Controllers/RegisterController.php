<?php

namespace App\Controllers;

use Core\Database;
use Core\Validacao;

class RegisterController
{
    public function index()
    {
        return view('register', template:'guest');
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function register()
    {
        $validacao = Validacao::validar([
            'nome' => ['required'],
            'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
            'senha' => ['required', 'min:8', 'max:30', 'strong']
        ], request()->all());

        if ($validacao->naoPassou()) {
            return view('register', template:'guest');
        }

        $database = new Database(config('database'));

        $nome = request()->post('nome');
        $email = request()->post('email');
        $senha = request()->post('senha');

        $database->query(
            'INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)',
            params: [
                'nome' => $nome,
                'email' => $email,
                'senha' => password_hash($senha, PASSWORD_BCRYPT)
            ]
        );

        flash()->push('mensagem', 'Registrado com sucesso!');
        return redirect('login');
    }

}