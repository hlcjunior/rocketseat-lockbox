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
        ], request()->all());

        if ($validacao->naoPassou()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        $email = request()->post('email');
        $senha = request()->post('senha');

        $usuario = $database->query(
            'SELECT * FROM usuarios WHERE email = :email',
            Usuario::class,
            compact('email')
        )->fetch();

        if (!$usuario || !password_verify($senha, $usuario->senha)) {
            flash()->push('validacoes', ['email' => ['Usuário ou senha incorretos!']]);
            return view('login', template: 'guest');
        }

        session()->set('auth', $usuario);

        flash()->push('mensagem', 'Bem vindo ' . $usuario->nome . '!');

        return redirect('notas');

    }

}