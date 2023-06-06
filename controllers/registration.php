<?php

require_once('models/base.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $model = new Base();
  $existingUser = $model->getUserByUsername($username);

  if ($existingUser !== false) {
    echo "Username already exists. Please choose a different username.";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $result = $model->createUser($username, $hashedPassword);

    if ($result) {
      
      $_SESSION['user_id'] = $result;
      $_SESSION['username'] = $username;

      
      header("Location: index.php");
      exit();
    } else {
      echo "Failed to register user.";
    }
  }
}


if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
  
  header("Location: index.php");
  exit();
}

require('views/registration.php');
