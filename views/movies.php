<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
</head>
<body>
    <h1>Movie List</h1>
    <ul>
    <?php foreach ($movies as $movie): ?>
        <li>
            <a href="index.php?action=show&id=<?php echo $movie['id']; ?>">
                <?php echo $movie['title']; ?>
            </a>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>