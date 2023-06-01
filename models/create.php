public function getMovieById($id) {
        
        $query = "SELECT * FROM movies WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMovie($data) {
        
        $query = "INSERT INTO movies (title, description, release_year) VALUES (:title, :description, :release_year)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':release_year', $data['release_year']);
        $stmt->execute();
        return $this->db->lastInsertId();
    }