<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
    <link rel="stylesheet" href="css/movieList.css">
</head>
<body>
    <h1>Movie List</h1>

    <div id="search">
        <form action="index.php?controller=movies" method="GET">
            <input type="hidden" name="controller" value="movies">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="Search">
        </form>
    </div>
    <br>

    <form action="index.php" method="GET">
        <input type="hidden" name="controller" value="movies">
        <select name="category">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['name']; ?>">
                    <?php echo $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>
    <br>

    <ul>
        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <li>
                    <a href="index.php?controller=movieDetails&id=<?php echo $movie['movie_id']; ?>">
                        <?php echo $movie['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No movies found.</li>
        <?php endif; ?>
    </ul>

    <a href="index.php?controller=home">Back to home</a>
</body>
</html>
