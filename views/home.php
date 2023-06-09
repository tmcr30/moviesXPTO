<!DOCTYPE html>
<html>
<head>
  <title>MoviesXPTO</title>
  <link rel="stylesheet" href="css/movieDetails.css">
</head>
<body>
  <h1>Welcome to MoviesXPTO</h1>

  <ul>
  <li><a href="index.php?controller=movies">Browse Movies</a></li>
  <?php if (isset($_SESSION['admin_id'])): ?>
    <li><a href="index.php?controller=create">Add Movie</a></li>
    <li><a href="index.php?controller=logout">Logout</a></li>
  <?php elseif (isset($_SESSION['user_id'])): ?>
    <li><a href="index.php?controller=logout">Logout</a></li>
  <?php else: ?>
    <li><a href="index.php?controller=login">Login</a></li>
  <?php endif; ?>
  </ul>

  
  <div class="random_movies">
  <h2>Movies Suggestion</h2>
    <?php foreach ($randomMovies as $movie): ?>
      <div class="random_poster">
        <p></p>
        <a href="index.php?controller=movieDetails&id=<?php echo $movie['movie_id']; ?>">
          <img src="images/<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?> Poster" width="200" height="200">
        </a>
      </div>  
    <?php endforeach; ?>
  </div>
</body>
</html>