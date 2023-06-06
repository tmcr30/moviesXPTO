<?php

require("models/movies.php");

$model = new Movies();

$movies = $model->getAllMovies();

if( empty($movies) ) {
    http_response_code(404);
    die("Página não existe");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id']) && isset($_POST['rating'])) {
    $movieId = $_POST['movie_id'];
    $ratingValue = $_POST['rating'];

    $model = new Movies();
    $userId = $_SESSION['user_id'];

    
    $result = $model->addRating($movieId, $userId, $ratingValue);

    if ($result) {
        header("Location: index.php?controller=movieDetails&id=$movieId");
        exit();
    } else {
        echo "Failed to add rating.";
    }
}

$controller = new Movies();

if (isset($_GET['action']) && $_GET['action'] === 'rateMovie') {
    $controller->rateMovie();
} else {
    $controller->getAllMovies();
}

require("views/movies.php");

