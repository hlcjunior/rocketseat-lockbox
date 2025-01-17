<?php

namespace App\Controllers;

class LogoutController
{
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function __invoke()
    {
        session_destroy();
        return redirect('login');
    }
}