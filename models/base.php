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
    
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $query = $this->db->prepare("
            SELECT user_id, username, password
            FROM users
            WHERE username = :username
        ");
    
        $query->execute([
            ':username' => $username
        ]);
    
        return $query->fetch();
    }

    public function getCommentsByMovieId($movieId)
    {
        $query = $this->db->prepare("
            SELECT comments.*, users.username
            FROM comments
            INNER JOIN users ON comments.user_id = users.user_id
            WHERE comments.movie_id = :movie_id
        ");
    
        $query->execute([
            ':movie_id' => $movieId
        ]);
    
        return $query->fetchAll();
    }
    
    public function addComment($movieId, $userId, $comment)
    {
        $query = $this->db->prepare("
            INSERT INTO comments (movie_id, user_id, comment_text, created_at)
            VALUES (:movie_id, :user_id, :comment_text, NOW())
        ");

        $query->execute([
            ':movie_id' => $movieId,
            ':user_id' => $userId,
            ':comment_text' => $comment
        ]);

        return $query->rowCount() > 0; 
    }
    
    public function getMovieById($movieId)
    {
        $query = $this->db->prepare("
            SELECT
                m.movie_id, m.title, m.description, m.release_date, m.poster, c.name
            FROM 
                movies AS m
            INNER JOIN 
                categories AS c ON m.category_id = c.category_id
            WHERE 
                m.movie_id = :id
        ");
    
        $query->execute([
            ':id' => $movieId
        ]);
    
        return $query->fetch();
    }

    public function deleteComment($commentId)
    {
        $query = $this->db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        $query->execute([':comment_id' => $commentId]);
        return $query->rowCount() > 0;
    }

}



