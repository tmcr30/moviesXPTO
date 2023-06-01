<!DOCTYPE html>
<html>
<head>
    <title>Movie List</title>
</head>
<body>
    <h1>Movie List</h1>
    <ul>
    <?php
            foreach($movies as $movie) {
                echo '
                        <li>
                            <a href="/movieDetails/' .$movie["movie_id"]. '">
                                
                                ' .$movie["title"]. '
                            </a>
                        </li>
                ';
            }
    ?>
</body>
</html>

