<?php

namespace App\Middlewares;

class AuthMiddleware
{
    /** @noinspection PhpVoidFunctionResultUsedInspection
     * @noinspection PhpUnused
     */
    public function handle()
    {
        if(!auth()){
            return redirect('login');
        }

        return null;

    }
}