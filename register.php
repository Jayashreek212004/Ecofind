<?php
// register.php
// You can later add PHP code here for form handling
include 'db.php'; // Add your DB connection file if not already
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];
    if ($password !== $confirm) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Store password as integer (not recommended, but matches your schema)
        $password_int = intval($password);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $username, $email, $password_int);
        if ($stmt->execute()) {
            // Registration successful, redirect
            header("Location: landing.php");
            exit();
        } else {
            echo "<script>alert('Registration failed');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register your account</title>
  <style>
    body {
      background: #e6f2ea;
      margin: 0;
      font-family: Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Logo outside the card */
    .logo-outer-circle {
      margin-top: 44px;
      margin-bottom: -42px;
      z-index: 2;
      background: #fff;
      border-radius: 50%;
      width: 90px;
      height: 90px;
      box-shadow: 0 8px 32px rgba(58,125,68,0.10);
      border: 3px solid #3A7D44;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .logo-outer-circle img {
      width: 85px;
      height: 85px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
    }

    .container {
      max-width: 400px;
      width: 95%;
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 24px rgba(0,0,0,0.15);
      padding: 48px 24px 32px 24px;
      margin-bottom: 32px;
      position: relative;
      z-index: 1;
    }

    .register-form {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .register-form h2 {
      color: #3A7D44;
      margin-top: 0;
      margin-bottom: 18px;
      text-align: center;
      font-size: 1.4em;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .register-form label {
      font-weight: 500;
      margin-bottom: 4px;
    }

    .register-form input {
      padding: 10px;
      border-radius: 4px;
      border: 1px solid #bbb;
      font-size: 1em;
      margin-bottom: 8px;
      outline: none;
      transition: border-color 0.2s;
      background: #f4f9f5;
    }
    .register-form input:focus {
      border-color: #3A7D44;
    }

    .signup-btn {
      background: #24a424;
      color: #fff;
      border: none;
      padding: 13px;
      font-size: 1.1em;
      font-weight: 600;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.18s;
      letter-spacing: 0.3px;
    }
    .signup-btn:hover {
      background: #188918;
    }

    .signin-link {
      text-align: center;
      padding-top: 14px;
      font-size: 1em;
    }
    .signin-link a {
      color: #104a9a;
      text-decoration: underline;
      margin-left: 3px;
    }

    /* Responsive for mobile */
    @media (max-width: 480px) {
      .container {
        padding: 44px 8px 16px 8px;
      }
      .logo-outer-circle {
        width: 60px;
        height: 60px;
        margin-top: 18px;
        margin-bottom: -30px;
      }
      .logo-outer-circle img {
        width: 54px;
        height: 54px;
      }
    }
  </style>
</head>
<body>
  <!-- Logo above/outside card -->
  <div class="logo-outer-circle">
    <img src="logo.jpg" alt="EcoFinds Logo">
  </div>

  <div class="container">
    <div style="position: absolute; top: 20px; right: 30px; z-index: 10;">
      <a href="landing.php" class="btn btn-secondary" style="font-size:16px;">Back</a>
    </div>
    <form class="register-form" method="POST" action="">
      <h2>Register your account</h2>

      <label for="username">Username</label>
      <input type="text" name="username" id="username" placeholder="Enter a username..." required>

      <label for="email">Email address</label>
      <input type="email" name="email" id="email" placeholder="Enter your email address..." required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Enter your password..." required>

      <label for="confirm-password">Confirm Password</label>
      <input type="password" name="confirm-password" id="confirm-password" placeholder="Enter your password again..." required>

      <button type="submit" class="signup-btn">Sign up</button>
      <p class="signin-link">Already have an account? <a href="login.php">Sign in.</a></p>
    </form>
  </div>
</body>
</html>
