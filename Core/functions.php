<?php

use Core\Flash;
use Core\Request;
use Core\Session;
use JetBrains\PhpStorm\NoReturn;

function base_path(string $path): string
{
    return __DIR__ . '/../' . $path;
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
function view(string $view, array $data = [], string $template = 'app'): mixed
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    return require base_path("views/template/$template.php");
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
    $config = require base_path('/config/config.php');

    if (strlen($chave) > 0) {
        $tmp = null;
        foreach (explode('.', $chave) as $index => $key) {
            $tmp = $index == 0 ? $config[$key] : $tmp[$key];
        }
        return $tmp;
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

function redirect(string $uri): void
{
    header("Location: " . getBaseURL() . "$uri");
}

function request(): Request
{
    return new Request();
}

function session(): Session
{
    return new Session();
}

function encrypt($data): string
{
    $first_key = base64_decode(config('security.first_key'));
    $second_key = base64_decode(config('security.second_key'));

    $method = "aes-256-cbc";
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length);

    $first_encrypted = openssl_encrypt($data, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    return base64_encode($iv . $second_encrypted . $first_encrypted);
}

function decrypt($input): bool|string
{
    $first_key = base64_decode(config('security.first_key'));
    $second_key = base64_decode(config('security.second_key'));
    $mix = base64_decode($input);

    $method = "aes-256-cbc";
    $iv_length = openssl_cipher_iv_length($method);

    $iv = substr($mix, 0, $iv_length);
    $second_encrypted = substr($mix, $iv_length, 64);
    $first_encrypted = substr($mix, $iv_length + 64);

    $data = openssl_decrypt($first_encrypted, $method, $first_key, OPENSSL_RAW_DATA, $iv);
    $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, true);

    if (hash_equals($second_encrypted, $second_encrypted_new)) {
        return $data;
    }

    return false;
}

function env(string $key, ?string $default = null)
{
    $env = parse_ini_file(base_path('.env'));
    return $env[$key] ?? $default;
}