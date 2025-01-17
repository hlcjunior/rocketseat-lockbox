<?php

namespace Core;

class Flash
{

    public function push(string $chave, mixed $valor): void
    {
        $_SESSION["flash_$chave"] = $valor;
    }

    public function get(string $chave): mixed
    {
        if (!isset($_SESSION["flash_$chave"])) {
            return false;
        }

        $valor = $_SESSION["flash_$chave"];

        unset($_SESSION["flash_$chave"]);

        return $valor;
    }

}