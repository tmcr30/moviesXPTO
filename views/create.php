<?php

if (!isset($_SESSION['admin_id'])) {
    
    header("Location: index.php?controller=home");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Insert Movie</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Insert Movie</h1>
    <form id="movie_form" action="index.php?controller=create" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>
        
        <label for="release_date">Release Date:</label>
        <input type="number" name="release_date" id="release_date" required><br>
        
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>">
                    <?php echo $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="poster">Poster:</label>
        <input type="file" name="poster" id="poster" accept="image/*" required><br>
        
        <input type="submit" value="Create">
    </form>
    <a href="index.php?controller=home">Back to home</a>

    
</body>
</html>