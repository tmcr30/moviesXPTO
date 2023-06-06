<?php

require_once('models/movies.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id'])) {
  $movieId = $_POST['movie_id'];

  
  $model = new Movies();

  
  $result = $model->deleteMovie($movieId);

  if ($result) {
    
    header("Location: index.php?controller=movies");
    exit();
  } else {
    
    echo "Failed to delete the movie.";
    exit();
  }
}
?>