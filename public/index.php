<?php

require "../vendor/autoload.php";

//require '../App/Models/Usuario.php';

//spl_autoload_register(function ($class) {
//    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
//    require base_path("$class.php");
//});

session_start();

require base_path("/config/routes.php");

