<?php

require_once('models/base.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $model = new Base();
    $admin = $model->checkAdminCredentials($username, $password);

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: index.php?controller=create');
        exit;
    } else {
        $error = "Invalid credentials";
    }
}

require('views/login.php');