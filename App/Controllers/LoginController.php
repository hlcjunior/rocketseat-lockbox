<?php

namespace App\Controllers;

use App\Models\Usuario;
use Core\Database;
use Core\Validacao;

class LoginController
{
    public function index()
    {
        return view('login', template: 'guest');
    }

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function login()
    {
        $validacao = Validacao::validar([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ], $_POST);

        if ($validacao->naoPassou()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = $database->query(
            'SELECT * FROM usuarios WHERE email = :email',
            Usuario::class,
            compact('email')
        )->fetch();

        if (!$usuario || !password_verify($senha, $usuario->senha)) {
            flash()->push('validacoes', ['email' => ['Usuário ou senha incorretos!']]);
            return view('login', template: 'guest');
        }

        $_SESSION['auth'] = $usuario;

        flash()->push('mensagem', 'Bem vindo ' . $usuario->nome . '!');

        return redirect('notas');

    }

}