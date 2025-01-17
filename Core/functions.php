<?php

use Core\Flash;
use JetBrains\PhpStorm\NoReturn;


function base_path(string $path): string
{
    return __DIR__ . '/../'.$path;
}
/** @noinspection PhpUnused */
#[NoReturn] function dd(...$dump): void
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
    die();
}

/** @noinspection PhpUnused */
function dump(...$dump): void
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}

#[NoReturn] function abort(int $code): void
{
    http_response_code($code);
    view($code);
    die();
}

/** @noinspection PhpUnusedParameterInspection */
function view(string $view, array $data = []): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require base_path("views/template/app.php");
}

function getBaseURL(): string
{
    return '/lockbox/';
}

function flash(): Flash
{
    return new Flash();
}

function config($chave = null): mixed
{
    $config = require base_path('config.php');

    if (strlen($chave) > 0) {
        return $config[$chave];
    }

    return $config;
}

function auth(): null|object
{
    if (!isset($_SESSION['auth'])) {
        return null;
    }

    return $_SESSION['auth'];
}

function old(string $campo): string
{
    return $_POST[$campo] ?? '';
}