<!DOCTYPE html>
<html>
<head>
  <title>MoviesXPTO</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Welcome to MoviesXPTO</h1>

  <ul>
    <li><a href="index.php?controller=movies">Browse Movies</a></li>
    <?php if (isset($_SESSION['admin_id'])): ?>
      <li><a href="index.php?controller=create">Add Movie</a></li>
      <li><a href="index.php?controller=logout">Logout</a></li>
    <?php else: ?>
      <li><a href="index.php?controller=login">Login</a></li>
    <?php endif; ?>
  </ul>
</body>
</html>