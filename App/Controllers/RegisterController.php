<?php

namespace App\Controllers;

use Core\Database;
use Core\Validacao;

class RegisterController
{
    public function index()
    {
        return view('register');
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function register()
    {
        $validacao = Validacao::validar([
            'nome' => ['required'],
            'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
            'senha' => ['required', 'min:8', 'max:30', 'strong']
        ], $_POST);

        if ($validacao->naoPassou()) {
            return view('register');
        }

        $database = new Database(config('database'));

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

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