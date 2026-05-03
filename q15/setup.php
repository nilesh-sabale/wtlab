<?php
$conn = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS complaint_db";
mysqli_query($conn, $sql);

mysqli_select_db($conn, 'complaint_db');

$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject VARCHAR(200),
    description TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

echo "Database created!<br>";
echo "<a href='index.php'>Go to Home</a>";
?>
