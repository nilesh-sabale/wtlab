<?php
// Create database and tables
$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS attendance_db";
$conn->query($sql);

$conn->select_db('attendance_db');

// Create students table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    roll_no VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create attendance table
$sql = "CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    date DATE NOT NULL,
    status ENUM('present', 'absent') DEFAULT 'absent',
    marked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    UNIQUE KEY unique_attendance (student_id, date)
)";
$conn->query($sql);

// Create teacher account (username: teacher, password: teacher123)
$sql = "CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";
$conn->query($sql);

$hashedPassword = password_hash('teacher123', PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO teachers (username, password) VALUES ('teacher', '$hashedPassword')";
$conn->query($sql);

echo "✅ Database setup completed!<br>";
echo "Teacher Login: username = teacher, password = teacher123<br>";
echo "<a href='index.php'>Go to Home</a>";

$conn->close();
?>
