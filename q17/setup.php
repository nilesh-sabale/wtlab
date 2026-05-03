<?php
$conn = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS waste_db";
mysqli_query($conn, $sql);

mysqli_select_db($conn, 'waste_db');

$sql = "CREATE TABLE IF NOT EXISTS waste_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    location VARCHAR(200),
    waste_type VARCHAR(50),
    description TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

echo "Database created!<br>";
echo "<a href='index.php'>Go to Home</a>";
?>
