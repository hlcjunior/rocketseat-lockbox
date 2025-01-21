<?php

namespace App\Models;

class Nota
{
    public int $id;
    public int $usuario_id;
    public string $titulo;
    public string $nota;
    public string $data_criacao;
    public string $data_atualizacao;

}