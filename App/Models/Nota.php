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

    public static function delete(int $id): void
    {
        $db = new Database(config('database'));

        $db->query(
            'DELETE FROM notas WHERE id = :id',
            params: [
                'id' => request()->post('id')
            ]
        );
    }

    public static function update(int $id, string $titulo, string $nota): void
    {
        $db = new Database(config('database'));

        $db->query(
            'UPDATE notas SET titulo = :titulo, nota = :nota, data_atualizacao = :data_atualizacao WHERE id = :id',
            params: [
                'titulo' => $titulo,
                'nota' => $nota,
                'data_atualizacao' => date('Y-m-d H:i:s'),
                'id' => $id
            ]
        );

    }
}