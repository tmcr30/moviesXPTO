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
                categories USING (categorie_id)
    
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getMovieDetails($id) {

        $query = $this->db->prepare("
            SELECT
                movie_id, title, description, 
                release_date, categorie_id
            FROM movies
            WHERE movie_id = ?
        ");

        $query->execute([
            $id
        ]);

        return $query->fetch();

    }
}