<?php

namespace App\Controllers\Notas;

class IndexController
{
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function __invoke()
    {
        if(!auth()){
            return redirect('login');
        }

        return view('notas', ['user' => auth()]);
    }
}