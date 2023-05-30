<!DOCTYPE html>
<html>
<head>
    <title>Create Movie</title>
</head>
<body>
    <h1>Create Movie</h1>
    <form action="index.php?action=store" method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" required><br>
        <label>Description:</label><br>
        <textarea name="description" required></textarea><br>
        <label>Release Year:</label><br>
        <input type="number" name="release_year" required><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>