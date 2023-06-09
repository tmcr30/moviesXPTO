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
            ORDER BY
                title ASC    
    
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getMovieDetails($id) {
        $query = $this->db->prepare("
            SELECT
                m.movie_id, m.title, m.description, m.release_date, m.poster, c.name
            FROM movies AS m
            INNER JOIN categories AS c ON m.category_id = c.category_id
            WHERE m.movie_id = :id
        ");
    
        $query->execute([
            ':id' => $id
        ]);
    
        return $query->fetch();
    }

    public function getFourRandomMovies() {
        $query = $this->db->prepare("
            SELECT
                movie_id,
                title,
                poster
            FROM
                movies
            INNER JOIN
                categories USING (category_id)
            ORDER BY
                RAND()
            LIMIT 4
        ");

        $query->execute();

        return $query->fetchAll();
    }   

    public function deleteMovie($movieId) {
        $query = $this->db->prepare("
          DELETE FROM movies
          WHERE movie_id = :movie_id
        ");
      
        try {
          $query->bindValue(':movie_id', $movieId, PDO::PARAM_INT);
          $query->execute();
          return true;
        } catch (PDOException $e) {
          error_log("Error deleting movie: " . $e->getMessage());
          return false;
        }
    }

    public function rateMovie()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['movie_id']) && isset($_POST['rating'])) {
            $movieId = $_POST['movie_id'];
            $ratingValue = $_POST['rating'];

            $model = new Movies();
            $userId = $_SESSION['user_id'];


            $result = $model->addRating($movieId, $userId, $ratingValue);

            if ($result) {
                header("Location: index.php?controller=movieDetails&id=$movieId");
                exit();
            } else {
                echo "Failed to add rating.";
            }
        }
    }

    public function addRating($movieId, $userId, $ratingValue)
    {
        $query = $this->db->prepare("
            INSERT INTO ratings (movie_id, user_id, rating_value)
            VALUES (:movie_id, :user_id, :rating_value)
        ");

        $query->execute([
            ':movie_id' => $movieId,
            ':user_id' => $userId,
            ':rating_value' => $ratingValue
        ]);

        return $query->rowCount() > 0;
    }

    public function getAverageRating($movieId)
    {
        $query = $this->db->prepare("
            SELECT AVG(rating_value) AS average_rating
            FROM ratings
            WHERE movie_id = :movie_id
        ");

        $query->execute([
            ':movie_id' => $movieId
        ]);

        $result = $query->fetch();
        return $result['average_rating'] ?? 0;
    }

    public function searchMovies($query)
    {
        $query = "%$query%";
        $statement = $this->db->prepare("
            SELECT
                movie_id,
                title
            FROM
                movies
            INNER JOIN
                categories USING (category_id)
            WHERE
                title LIKE :query
            ORDER BY
                title ASC
        ");

        $statement->execute([
            ':query' => $query
        ]);

        return $statement->fetchAll();
    }

    public function getAllCategories() {
        $query = $this->db->prepare("
            SELECT category_id, name
            FROM categories
        ");
    
        $query->execute();
    
        return $query->fetchAll();
    }

        public function getMoviesByCategory($category)
    {
        $query = $this->db->prepare("
            SELECT
                m.movie_id,
                m.title
            FROM
                movies AS m
            INNER JOIN
                categories AS c ON m.category_id = c.category_id
            WHERE
                c.name = :category
            ORDER BY
                m.title ASC
        ");

        $query->execute([
            ':category' => $category
        ]);

        return $query->fetchAll();
    }
}   
    