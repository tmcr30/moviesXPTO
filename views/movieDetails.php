<!DOCTYPE html>
<html>
<head>
    <title><?php echo $movie['title']; ?></title>
    <link rel="stylesheet" href="css/movieDetails.css">
</head>
<body>
    <h1><?php echo $movie['title']; ?></h1>
    <div id="movieDetails">
        <div id="poster">
            <img src="images/<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?> Poster" width="650" height="650">
        </div>
        <p>Description:</p>
        <p><?php echo $movie['description']; ?></p>
        <p>Release Year:</p>
        <p><?php echo $movie['release_date']; ?></p>
        <p>Genre:</p>
        <p><?php echo $movie['name']; ?></p>
        <br>
        
        <?php if (isset($_SESSION['admin_id'])): ?>
            <form action="index.php?controller=delete" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                <input type="submit" value="Delete Movie">
            </form>
        <?php endif; ?>
        <br>

        <?php
            $model = new Movies();
            $averageRating = $model->getAverageRating($movie['movie_id']);
        ?>

        <p>Average Rating: <?php echo $averageRating; ?></p>
        <br>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="index.php?controller=movies&action=movies" method="POST">
                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                <label for="rating">Rate this movie:</label>
                <select name="rating" id="rating">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                <input type="submit" value="Submit Rating">
            </form>
        <?php endif; ?>

        <br>
        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="index.php?controller=movieDetails&id=<?php echo $movie['movie_id']; ?>" method="POST">
                <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                <label for="comment">Leave a comment:</label>
                <br>
                <textarea name="comment" id="comment" rows="4" cols="50"></textarea>
                <br>
                <input type="submit" value="Submit">
            </form>
        <?php endif; ?>
        <br>

    <?php if (!empty($comments)): ?>
        <h2>Comments:</h2>
        <ul>
            <?php foreach ($comments as $comment): ?>
                <li>
                    <br>
                    <strong>User:</strong> <?php echo $comment['username']; ?><br>
                    <strong>Comment:</strong> <?php echo $comment['comment_text']; ?><br>
                    <em>Posted at: <?php echo $comment['created_at']; ?></em>
                    <br>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <form action="index.php?controller=deleteComment" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                            <input type="hidden" name="movie_id" value="<?php echo $movie['movie_id']; ?>">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                            <br>
                            <input type="submit" value="Delete Comment">
                        </form>
                        <br>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <?php if (isset($_SESSION['user_id'])): ?>
            <br>
            <p>No comments yet. Be the first to leave a comment!</p>
        <?php elseif (!isset($_SESSION['admin_id'])): ?>
            <p><a href="index.php?controller=login">Login</a> to leave a comment.</p>
        <?php endif; ?>
    <?php endif; ?>
    </div>
    
    <a href="index.php?controller=movies">Back to movies</a>
    <br>
    <a href="index.php?controller=home">Back to home</a>
</body>
</html>
