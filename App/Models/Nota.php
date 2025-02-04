<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public int $id;
    /** @noinspection PhpUnused */
    public int $usuario_id;
    public string $titulo;
    public string $nota;
    /** @noinspection PhpUnused */
    public string $data_criacao;
    /** @noinspection PhpUnused */
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
                'id' => $id
            ]
        );
    }

    public static function update(int $id, string $titulo, ?string $nota = null): void
    {
        $db = new Database(config('database'));

        $set = 'titulo = :titulo, data_atualizacao = :data_atualizacao';

        if(session()->get('mostrar')) {
            $set .= ', nota = :nota';
        }

        $db->query(
            "UPDATE notas SET $set WHERE id = :id",
            params: array_merge([
                'titulo' => $titulo,
                'data_atualizacao' => date('Y-m-d H:i:s'),
                'id' => $id
            ], session()->get('mostrar') ? ['nota' => $nota] : [])
        );

    }

    public function nota(): string
    {
        if(session()->get('mostrar')) {
            return $this->nota;
        }

        return str_repeat('*', strlen($this->nota));

    }
}