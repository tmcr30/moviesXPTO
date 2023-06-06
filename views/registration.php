<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>Sign up</h1>
  <form id="registration_form" action="index.php?controller=registration" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br>
    
    <input type="submit" value="Sign Up">
  </form>
  <a href="index.php?controller=login">Login</a>
</body>
</html>