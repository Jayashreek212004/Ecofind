<?php
// db.php — database connection for hackathon_db
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username   = "root";       // default for XAMPP
$password   = "";           // default for XAMPP
$dbname     = "hackathon_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// use utf8
$conn->set_charset("utf8mb4");
?>
