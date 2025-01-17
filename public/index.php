<?php

require "../Core/functions.php";

//require '../App/Models/Usuario.php';

spl_autoload_register(function ($class) {
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    require base_path("$class.php");
});

session_start();

require "../routes.php";

