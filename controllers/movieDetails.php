<?php

require_once('models/base.php');
require_once("models/movies.php");

$model = new Base();
$movieId = $_GET['id'];
$movie = $model->getMovieById($movieId);
$comments = $model->getCommentsByMovieId($movieId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id']) && isset($_POST['comment'])) {
    $commentMovieId = $_POST['movie_id'];
    $comment = $_POST['comment'];

    $userId = $_SESSION['user_id'];

    
    $result = $model->addComment($commentMovieId, $userId, $comment);

    if ($result) {
        header("Location: index.php?controller=movieDetails&id=$commentMovieId");
        exit();
    } else {
        echo "Failed to add comment.";
    }
}

require('views/movieDetails.php');