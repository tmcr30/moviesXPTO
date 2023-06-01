<?php


require("models/movies.php");

$model = new Movies();

$movies = $model->getAllMovies();

if( empty($movies) ) {
    http_response_code(404);
    die("Página não existe");
}

require("views/movies.php");




