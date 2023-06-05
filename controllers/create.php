<?php

require_once('models/Create.php');

$model = new Create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = $model->createMovie($_POST);
    if ($success) {
        
        header('Location: index.php?controller=movies');
        exit;
    } else {
        $error = "Error creating movie";
    }
}

$categories = $model->getAllCategories();

require('views/create.php');