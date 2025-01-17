<?php

namespace App\Controllers;

class DashboardController
{
    /** @noinspection PhpVoidFunctionResultUsedInspection */
    public function __invoke()
    {
        if(!auth()){
            return redirect('login');
        }

        return view('dashboard', ['user' => auth()]);
    }
}