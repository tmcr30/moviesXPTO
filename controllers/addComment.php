<?php

require_once('models/base.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id']) && isset($_POST['comment'])) {
    $movieId = $_POST['movie_id'];
    $comment = $_POST['comment'];

    $model = new Base();
    $userId = $_SESSION['user_id'];

    
    $result = $model->addComment($movieId, $userId, $comment);

    if ($result) {
        header("Location: index.php?controller=movieDetails&id=$movieId");
        exit();
    } else {
        echo "Failed to add comment.";
    }
}
?>