<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

   $sql = "SELECT * FROM logins WHERE username = '$username' AND password = '$password'";
   $result = $mysqli->query($sql);

   if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $_SESSION['username']= $row['username'];
    header('Location: index.php');
    exit();
   }else{
    echo 'username atau password salah.';
   }


}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .login-container button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="#" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button name='submit' class='btn' type="submit">Login</button>
        </form>
    </div>
</body>
</html>
