<?php

namespace App\Controllers\Notas;

use JetBrains\PhpStorm\NoReturn;

class CriarController
{
    public function index()
    {
        return view('notas/criar');
        
    }

    #[NoReturn] public function store(): void
    {
        dd($_POST);
    }

}