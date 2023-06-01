<?php
session_start();

define("ENV", parse_ini_file(".env"));

$controller = "home";

if (isset($_GET["controller"])) {
    $controller = $_GET["controller"];
}

$controllerFile = "controllers/" . $controller . ".php";

if (file_exists($controllerFile)) {
    require($controllerFile);
} else {
    http_response_code(404);
    die("Controller not found");
}


