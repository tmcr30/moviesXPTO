<?php

require_once('models/base.php');

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("Location: index.php?controller=home");
    exit();
}

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $model = new Base();

    
    $admin = $model->checkAdminCredentials($username, $password);
    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: index.php?controller=home');
        exit;
    }

    
    $user = $model->getUserByUsername($username);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $username; 
        header("Location: index.php?controller=home");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}

require('views/login.php');