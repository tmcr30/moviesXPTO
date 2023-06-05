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

        $query = $this->db->prepare("
            INSERT INTO movies (title, description, release_date, category_id)
            VALUES (:title, :description, :release_date, :category_id)
        ");

        try {
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':release_date', $release_date, PDO::PARAM_STR);
            $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error creating movie: " . $e->getMessage());
            return false;
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
?>