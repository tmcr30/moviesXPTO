<?php

require_once('base.php');

class Movies extends Base
{

    public function getAllMovies() {

        $query = $this->db->prepare("
            SELECT
                movie_id,
                title
            FROM
                movies
            INNER JOIN
                categories USING (category_id)
    
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getMovieDetails($id) {
        $query = $this->db->prepare("
            SELECT
                m.movie_id, m.title, m.description, m.release_date, c.name
            FROM movies AS m
            INNER JOIN categories AS c ON m.category_id = c.category_id
            WHERE m.movie_id = :id
        ");
    
        $query->execute([
            ':id' => $id
        ]);
    
        return $query->fetch();
    }
    
}