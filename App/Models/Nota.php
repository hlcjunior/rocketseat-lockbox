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

    public static function all(string $pesquisar = null): array
    {
        $database = new Database(config('database'));
        return $database->query(
            'SELECT * FROM notas WHERE usuario_id = :usuario_id' . (
            $pesquisar ? ' AND titulo LIKE :pesquisar' : null
            ),
            self::class,
            params: array_merge(
                ['usuario_id' => auth()->id],
                $pesquisar ? ['pesquisar' => "%$pesquisar%"] : []
            )
        )->fetchAll();
    }
}