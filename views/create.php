<!DOCTYPE html>
<html>
<head>
    <title>Insert Movie</title>
</head>
<body>
    <h1>Insert Movie</h1>
    <form id="movie_form" action="index.php?controller=create" method="POST">
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
        
        <input type="submit" value="Create">
    </form>
    <a href="index.php?controller=home">Back to home</a>

    
</body>
</html>