<?php

require("models/movies.php");

$model = new Movies();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id']) && isset($_POST['rating'])) {
    $movieId = $_POST['movie_id'];
    $ratingValue = $_POST['rating'];

    $userId = $_SESSION['user_id'];

    $result = $model->addRating($movieId, $userId, $ratingValue);

    if ($result) {
        header("Location: index.php?controller=movieDetails&id=$movieId");
        exit();
    } else {
        echo "Failed to add rating.";
    }
}


$categories = $model->getAllCategories();

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $movies = $model->getMoviesByCategory($category);
} else {
    $movies = $model->getAllMovies();
}

if (empty($movies)) {
    http_response_code(404);
    die("Página não existe");
}


if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $movies = $model->searchMovies($searchQuery);
} else if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $movies = $model->getMoviesByCategory($category);
} else {
    $movies = $model->getAllMovies();
}

if (empty($movies)) {
    http_response_code(404);
    die("No movies found");
}


ob_start();
require("views/movies.php");
$output = ob_get_clean();

echo $output;
