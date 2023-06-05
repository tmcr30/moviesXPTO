<!DOCTYPE html>
<html>
<head>
    <title><?php echo $movie['title']; ?></title>
</head>
<body>
    <h1><?php echo $movie['title']; ?></h1>
    <p><?php echo $movie['description']; ?></p>
    <p>Release Year: <?php echo $movie['release_date']; ?></p>
    <p>Genre:<?php echo $movie['name']; ?></p>

    <a href="index.php?controller=movies">Back to movies</a>
</body>
</html>