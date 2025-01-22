<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public int $id;
    public int $usuario_id;
    public string $titulo;
    public string $nota;
    public string $data_criacao;
    public string $data_atualizacao;

    public static function all(): array
    {
        $database = new Database(config('database'));
        return $database->query(
            'SELECT * FROM notas WHERE usuario_id = :usuario_id',
            self::class,
            params: ['usuario_id' => auth()->id]
        )->fetchAll();
    }
}