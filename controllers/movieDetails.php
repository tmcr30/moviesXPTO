<?php

if( !isset($id) || !is_numeric($id)) {
    http_response_code(400);
    die("Request inválido");
}

require("models/movies.php");

$model = new Movies();

$movie = $model->getMovieDetails( $id );

if( empty($movie) ) {
    http_response_code(404);
    die("Página não existe");
}

require("views/movieDetails.php");