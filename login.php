<?php
include 'db.php'; // Add your DB connection file if not already
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Example query, adjust table/column names as needed
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        // Replace with password_verify if using hashed passwords
        if ($row['password'] == $password) {
            // Successful login, redirect
            header("Location: landing.php");
            exit();
        } else {
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        echo "<script>
            if (confirm('User not found. Create account?')) {
                window.location.href = 'register.php';
            }
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-image: url("https://d1csarkz8obe9u.cloudfront.net/posterpreviews/powerpoint-eco-friendly-background-design-template-e139c36ec9e7e66ef0032a0669cf0802_screen.jpg?ts=1696278626"); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      position: relative;
      z-index: 0;
    }
    body::before {
      content: "";
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(255, 255, 255, 0.5);
      z-index: -1;
    }
    .container {
      max-width: 360px;
      margin: 50px auto;
      padding: 30px 10px;
      display: flex;
      flex-direction: column;
      align-items: center;
      background: transparent;
      position: relative;
      z-index: 1;
    }
    .avatar-placeholder {
      width: 120px;
      height: 120px;
      background: #fff;
      border: 2px solid #222;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 18px;
      box-sizing: border-box;
    }
    .avatar-placeholder img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
    }
    .form-box {
      width: 100%;
      background: #fff;
      border: 2px solid #222;
      border-radius: 20px;
      padding: 22px 20px 12px 20px;
      margin-bottom: 22px;
      box-sizing: border-box;
    }
    label {
      display: block;
      margin-top: 10px;
      font-size: 16px;
      margin-bottom: 5px;
      font-family: 'Comic Sans MS', cursive, sans-serif;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 11px 12px;
      margin-bottom: 10px;
      border: 2px solid #222;
      border-radius: 14px;
      background: #fff;
      font-size: 16px;
      outline: none;
      box-sizing: border-box;
      font-family: inherit;
    }
    .login-btn {
      width: 85%;
      margin: 0 auto;
      display: block;
      padding: 16px 0;
      background: #fff;
      border: 2px solid #222;
      border-radius: 16px;
      font-size: 24px;
      font-family: 'Comic Sans MS', cursive, sans-serif;
      cursor: pointer;
      margin-top: 15px;
      transition: background 0.2s;
    }
    .login-btn:hover {
      background: #f1f1f1;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="avatar-placeholder">
      <img src="logo.jpg" alt="Logo">
    </div>
    <div class="form-box">
      <form method="post" action="">
        <label for="email">Email / Username :</label>
        <input type="text" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button class="login-btn" type="submit">Login</button>
      </form>
    </div>
  </div>
  <div style="position: absolute; top: 20px; right: 30px; z-index: 10;">
    <a href="landing.php" class="btn btn-secondary" style="font-size:16px;">Back</a>
  </div>
</body>
</html>