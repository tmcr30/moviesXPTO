<?php

require_once('base.php');

class Create extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createMovie($data)
    {
        $title = isset($data['title']) ? trim($data['title']) : '';
        $description = isset($data['description']) ? trim($data['description']) : '';
        $release_date = isset($data['release_date']) ? $data['release_date'] : '';
        $category_id = isset($data['category']) ? intval($data['category']) : 0;

        $poster = isset($_FILES['poster']) ? $_FILES['poster'] : null;

        if ($poster && $poster['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $poster['tmp_name'];
            $originalFileName = $poster['name'];

            $uploadDirectory = 'images/';

            $destinationPath = $uploadDirectory . $originalFileName;

            
            if (move_uploaded_file($tempFilePath, $destinationPath)) {
                
                $query = $this->db->prepare("
                    INSERT INTO movies (title, description, release_date, category_id, poster)
                    VALUES (:title, :description, :release_date, :category_id, :poster)
                ");

                try {
                    $query->bindValue(':title', $title, PDO::PARAM_STR);
                    $query->bindValue(':description', $description, PDO::PARAM_STR);
                    $query->bindValue(':release_date', $release_date, PDO::PARAM_STR);
                    $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
                    $query->bindValue(':poster', $originalFileName, PDO::PARAM_STR);
                    $query->execute();
                    return true;
                } catch (PDOException $e) {
                    error_log("Error creating movie: " . $e->getMessage());
                    return false;
                }
            } else {
                
            }
        } else {
            
        }
    }

    public function getAllCategories()
    {
        $query = $this->db->prepare("
            SELECT category_id, name
            FROM categories
        ");

        $query->execute();

        return $query->fetchAll();
    }
}