<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define constants if not already defined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/food-order/'); // Adjust as needed for your project URL
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost'); // MySQL server address
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root'); // MySQL username
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', ''); // MySQL password (leave blank if no password)
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'food-order'); // Your database name
}

// Create database connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME, 3307);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: Debugging to confirm connection (remove this in production)
echo "Database connected successfully!";
?>
