<?php

require_once('base.php');

class User extends Base
{
    public function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->db->prepare("
            INSERT INTO users (username, password)
            VALUES (:username, :password)
        ");

        try {
            $query->bindValue(':username', $username, PDO::PARAM_STR);
            $query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

}