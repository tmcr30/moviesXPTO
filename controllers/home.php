<?php

require("models/movies.php");

$model = new Movies();

$movies = $model->getAllMovies();


require('views/home.php');