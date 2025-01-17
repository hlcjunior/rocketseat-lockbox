<?php

(new \Core\Route())
    ->get('/', \App\Controllers\IndexController::class)
    ->get('/login', [\App\Controllers\LoginController::class, 'index'])
    ->post('/login', [\App\Controllers\LoginController::class, 'login'])
    ->run();

    function carregarController(): void
    {

        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace(getBaseURL(), '', $uriPath);

        $controller = $uri ?: 'index';

        $controllerFile = "../controllers/$controller.controller.php";

        if (!file_exists($controllerFile)) {
            abort(404);
        }

        include $controllerFile;
    }

    carregarController();

