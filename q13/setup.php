<?php
$conn = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS login_db";
mysqli_query($conn, $sql);

mysqli_select_db($conn, 'login_db');

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100),
    password VARCHAR(255)
)";
mysqli_query($conn, $sql);

echo "Database created successfully!<br>";
echo "<a href='index.php'>Go to Home</a>";
?>
