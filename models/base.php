<?php

class Base
{
    public $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . ENV["DB_HOST"] . ";dbname=" . ENV["DB_NAME"] . ";charset=utf8mb4",
            ENV["DB_USER"],
            ENV["DB_PASSWORD"],
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }

    public function checkAdminCredentials($username, $password)
    {
        $query = $this->db->prepare("
            SELECT id
            FROM admin
            WHERE username = :username AND password = :password
        ");

        $query->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        return $query->fetch();
    }




}

