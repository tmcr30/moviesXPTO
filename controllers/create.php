<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $releaseYear = $_POST['release_year'];

    
    if (empty($title) || empty($description) || empty($releaseYear)) {
        die("Please fill in all the required fields.");
    }

    try {
        $stmt = $db->prepare("INSERT INTO movies (title, description, release_year) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $releaseYear]);

        
        header("Location: index.php?action=success");
        exit();
    } catch (PDOException $e) {
        die("Error storing the movie: " . $e->getMessage());
    }
} else {
    
    die("Invalid request.");
}

