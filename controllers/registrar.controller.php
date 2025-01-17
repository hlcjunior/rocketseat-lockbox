<?php

use Core\Database;
use Core\Validacao;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    view('registrar');
    exit();
}

$database = new Database(config('database'));

$validacao = Validacao::validar([
    'nome' => ['required'],
    'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
    'senha' => ['required', 'min:8', 'max:30', 'strong']
], $_POST);

if ($validacao->naoPassou('registrar')) {
    header('location: registrar');
    exit();
}

$database->query(
    'INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)',
    params: [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => password_hash($_POST['senha'], PASSWORD_BCRYPT)
    ]
);

flash()->push('mensagem', 'Registrado com sucesso!');
header('Location: login');

exit();




