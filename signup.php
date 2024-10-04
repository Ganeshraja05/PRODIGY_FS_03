<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
  mysqli_query($conn, $query);

  header('Location: login.php');
}
?>

<style>
  body {
    font-family: Arial, sans-serif;
    background-image: url('https://wallpapers.com/images/hd/red-and-black-aesthetic-ripple-r7yxh9vvxsewsfbr.jpg'); /* Add a background image */
    background-size: cover;
    background-position: center;
    height: 100vh;
    margin: 0;
  }

  .signup-form {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(0, 0, 0, 0.5); /* Change the background color to a semi-transparent black */
    border: 1px solid #444; /* Dark gray border */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  }

  .signup-form input[type="text"],
  .signup-form input[type="email"],
  .signup-form input[type="password"] {
    width: 100%;
    height: 40px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #555; /* Dark gray border */
    border-radius: 5px;
    background-color: rgba(0, 0, 0, 0.5); /* Change the background color to a semi-transparent black */
    color: #fff; /* White text */
  }

  .signup-form button[type="submit"] {
    width: 100%;
    height: 40px;
    background-color: rgba(0, 0, 255, 0.5); /* Change the background color to a semi-transparent blue */
    color: #fff; /* White text */
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .signup-form button[type="submit"]:hover {
    background-color: rgba(0, 0, 255, 0.7); /* Change the background color to a semi-transparent blue */
  }

  .signup-form a {
    text-align: center;
    display: block;
    margin-top: 20px;
    color: #fff; /* White text */
  }

  .signup-form a:hover {
    color: #ccc; /* Light gray text */
  }
  h2{
    color: #fff;
  }
</style>

<div class="signup-form">
  <form method="POST" action="signup.php">
    <h2>Sign up for an account</h2>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Sign up</button>
  </form>
  <a href="login.php">Already have an account? Log in</a>
</div>