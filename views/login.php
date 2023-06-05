<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="index.php?controller=login" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        
        <input type="submit" value="Login">
    </form>


    <a href="index.php?controller=home">Back to home</a>
</body>
</html>