<?php

require("models/movies.php");

$movies = new Movies();

$randomMovies = $movies->getFourRandomMovies();

$model = new Movies();

$movies = $model->getAllMovies();

require('views/home.php');

?>