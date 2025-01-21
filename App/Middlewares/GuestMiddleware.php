<?php

namespace App\Middlewares;

class GuestMiddleware
{
    /** @noinspection PhpVoidFunctionResultUsedInspection
     * @noinspection PhpUnused
     */
    public function handle()
    {
        if(auth()){
            return redirect('notas');
        }

        return null;
    }

}