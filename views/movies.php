<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
    <link rel="stylesheet" href="css/movieList.css">
</head>
<body>
    <h1>Movie List</h1>
    <ul>
    <?php foreach ($movies as $movie): ?>
        <li>
            <a href="index.php?controller=movieDetails&id=<?php echo $movie['movie_id']; ?>">
                <?php echo $movie['title']; ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>

    <a href="index.php?controller=home">Back to home</a>
</body>
</html>