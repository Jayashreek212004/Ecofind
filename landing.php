<?php
// Any PHP logic can go here if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Landing Page Wireframe with Navbar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #e7ece8;
    }
    .logo-style {
        height: 80px;
        width: 20%;
        max-width: 100px;
        min-width: 50px;
        object-fit: contain;
    }
    .custom-container {
        max-width: 1200px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 20px;
        min-height: 100vh;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }
    .header-icons {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cart, .profile-photo {
        width: 40px;
        height: 40px;
    }
    .cart {
        font-size: 1.5rem;
    }
    .profile-photo {
        border-radius: 50%;
        object-fit: cover;
    }
    .search-section {
        margin-bottom: 12px;
    }
    .button-style{
        height:38px;
        width:90px
    }
    .search-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d7d7d7;
        border-radius: 7px;
        font-size: 1rem;
        outline: none;
        box-sizing: border-box;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }
    .banner-style{
        height:389px;
        width:1200px
    }
    .action-buttons button {
        flex: 1;
        padding: 8px 0;
        border-radius: 7px;
        border: 1px solid #a0522d;
        background: #a0522d;
        color: #fff;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 0.18s;
    }
    .action-buttons button:hover {
        background: #8b4513;
    }
    .banner {
        height: 370px;
        background: #e8f4fc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1d3557;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }
    .all-categories {
        width: 100%;
        margin-bottom: 13px;
        padding: 10px 0;
        border: none;
        border-radius: 7px;
        background: #a0522d;
        color: #fff;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.17s;
    }
    .all-categories:hover {
        background: #8b4513;
    }
    .card-row {
        display: flex;
        gap: 12px;
        justify-content: space-between;
    }
    .card {
        flex: 1;
        height: 100px;
        background: #f4f4f4;
        border-radius: 11px;
    }
    @media (max-width: 500px) {
        .custom-container {
            max-width: 400px;
            padding: 10px 8px 20px 8px;
            border-radius: 18px;
        }
        .banner {
            height: 90px;
            font-size: 1.1rem;
        }
        .card {
            height: 60px;
        }
        .logo-style {
            width: 20%;
            max-width: 40px;
        }
        .cart, .profile-photo {
            width: 35px;
            height: 35px;
            font-size: 1.2rem;
        }
    }
  </style>
</head>
<body>
  <div class="container custom-container">
    <!-- Header -->
    <header class="header">
      <nav class="navbar navbar-expand-lg navbar-light bg-white w-100">
        <a class="navbar-brand" href="#">
          <img src="logo.jpg" class="logo-style" alt="Logo"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="view_items.php">Product</a>
            <a class="nav-link" href="seller_dashboard.php">Seller Dashboard</a>
            <a class="nav-link" href="add_items.php">My Shop</a>
            <a class="nav-link" href="add_items.php">History</a>
    
          </div>
        </div>
      </nav>
      <div class="header-icons">
        <a href="login.php" class="btn btn-primary" style="text-decoration:none;">Login</a>
        <a href="register.php" class="btn btn-primary button-style" style="text-decoration:none;">Sign Up</a>
        <span class="cart">&#128722;</span>
        <img src="https://static.vecteezy.com/system/resources/previews/022/014/159/original/avatar-icon-profile-icon-member-login-isolated-vector.jpg" class="profile-photo" alt="Profile"/>
      </div>
    </header>
    <!-- Search -->
    <div class="search-section">
      <input type="text" class="search-input" placeholder="Search ....">
    </div>
    <!-- Action Buttons -->
    <div class="action-buttons">
      <button>Sort</button>
      <button>Filter</button>
      <button>Groupby</button>
    </div>
    <!-- Banner -->
    <div class="banner">
      <img src="banner.jpg" class="banner-style"/>
    </div>
    <!-- All Categories -->
    <button class="all-categories">All Categories</button>
    <!-- Cards -->
   
  <div class="card-row">
  <div class="card" style="display:flex;align-items:center;justify-content:center;">
    <img src="images/iphone12.jpg" alt="iPhone 12" style="height:80px;">
  </div>
  <div class="card" style="display:flex;align-items:center;justify-content:center;">
    <img src="images/levis_jeans.jpg" alt="Levi's Jeans" style="height:80px;">
  </div>
  <div class="card" style="display:flex;align-items:center;justify-content:center;">
    <img src="images/ikea_chair.jpg" alt="IKEA Chair" style="height:80px;">
  </div>
</div>
  <!-- Bootstrap JS -->
   
      <!-- Add more images as needed -->
    </div>
</body>
</html>