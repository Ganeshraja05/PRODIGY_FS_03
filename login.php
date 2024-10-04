<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['user'] = $username;
    header('Location: home.php');
  } else {
    $error = "Invalid login credentials";
  }
}
?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-image: url('https://img.freepik.com/free-vector/abstract-red-light-lines-pipe-speed-zoom-black-background-technology_1142-8936.jpg'); /* Add a background image */
    background-size: cover;
    background-position: center;
    height: 100vh;
    margin: 0;
  }

  .login-form {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    background-color: #333; /* Dark gray background */
    border: 1px solid #444; /* Dark gray border */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }

  .login-form input[type="text"],
  .login-form input[type="password"] {
    width: 100%;
    height: 40px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #555; /* Dark gray border */
    border-radius: 5px;
    background-color: #444; /* Dark gray background */
    color: #fff; /* White text */
  }

  .login-form button[type="submit"] {
    width: 100%;
    height: 40px;
    background-color: #E50914; /* Netflix red button */
    color: #fff; /* White text */
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .login-form button[type="submit"]:hover {
    background-color: #FF3737; /* Netflix red button hover */
  }

  .login-form a {
    text-align: center;
    display: block;
    margin-top: 20px;
    color: #fff; /* White text */
  }

  .login-form a:hover {
    color: #ccc; /* Light gray text */
  }

  .error {
    color: #FF3737; /* Netflix red error text */
    font-size: 12px;
    margin-bottom: 10px;
  }
</style>

<div class="login-form">
  <form method="POST" action="login.php">
    <?php if (isset($error)) { ?>
      <p class="error"><?= $error ?></p>
    <?php } ?>
    <input type="text" name="username" placeholder="Email or phone number" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign In</button>
  </form>
  <a href="signup.php">Sign up</a>
</div>