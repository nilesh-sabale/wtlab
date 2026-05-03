<?php
require_once 'config.php';

// Create database and tables
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
$conn->query($sql);

$conn->select_db(DB_NAME);

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Create sessions table
$sql = "CREATE TABLE IF NOT EXISTS user_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_id VARCHAR(255) UNIQUE NOT NULL,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
$conn->query($sql);

// Insert demo users
$password = password_hash('password123', PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO users (username, password) VALUES 
    ('user1', '$password'),
    ('user2', '$password'),
    ('admin', '$password')";
$conn->query($sql);

$conn->close();

echo "✅ Database setup completed successfully!<br>";
echo "📝 Demo users created:<br>";
echo "- Username: user1, Password: password123<br>";
echo "- Username: user2, Password: password123<br>";
echo "- Username: admin, Password: password123<br><br>";
echo "<a href='login.php'>Go to Login Page</a>";
?>
