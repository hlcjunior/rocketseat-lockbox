<?php

//Se a requisição não for POST, redireciona para a página de login.
use App\Models\Usuario;
use Core\Database;
use Core\Validacao;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    view('login');
    exit();
}

$database = new Database(config('database'));

$validacao = Validacao::validar([
    'email' => ['required', 'email'],
    'senha' => ['required']
], $_POST);

if ($validacao->naoPassou()) {
    view('login');
    exit();
}

$email = $_POST['email'];
$senha = $_POST['senha'];
$usuario = $database->query(
    'SELECT * FROM usuarios WHERE email = :email',
    Usuario::class,
    compact('email')
)->fetch();

if (!$usuario || !password_verify($senha, $usuario->senha)) {
    flash()->push('validacoes', ['email'=>['Usuário ou senha incorretos!']]);
    view('login');
    exit();
}

$_SESSION['auth'] = $usuario;

flash()->push('mensagem', 'Bem vindo ' . $usuario->nome . '!');

echo 'Logado com sucesso!'.auth()->nome;
/*
header('Location: index');
exit();
*/



