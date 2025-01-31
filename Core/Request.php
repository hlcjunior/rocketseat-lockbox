<?php

namespace Core;

class Request
{
    public function get(string $key, mixed $default = null, string $prefix = null)
    {
        return isset($_GET[$key]) ? ($prefix ?: null) . $_GET[$key] : $default;
    }

    public function post(string $key, mixed $default = null, string $prefix = null)
    {
        return isset($_POST[$key]) ? ($prefix ?: null) . $_POST[$key] : $default;
    }

    public function all(): array
    {
        return $_POST;
    }

}