<?php
$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS vit_results");
$conn->select_db("vit_results");

// Drop and create table
$conn->query("DROP TABLE IF EXISTS students");

$sql = "CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    prn VARCHAR(50),
    department VARCHAR(50) DEFAULT 'Computer',
    semester INT,
    course VARCHAR(50),
    subject1_mse INT,
    subject1_ese INT,
    subject2_mse INT,
    subject2_ese INT,
    subject3_mse INT,
    subject3_ese INT,
    subject4_mse INT,
    subject4_ese INT
)";

$conn->query($sql);

// Insert sample data
$conn->query("INSERT INTO students (name, prn, department, semester, course, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese) VALUES 
    ('Nilesh Sabale', 'PRN001', 'Computer', 5, 'Computer Engineering', 25, 60, 28, 65, 22, 55, 27, 62),
    ('Rahul Sharma', 'PRN002', 'Computer', 6, 'Computer Engineering', 20, 50, 25, 58, 18, 45, 23, 52),
    ('Priya Patel', 'PRN003', 'Computer', 5, 'Computer Engineering', 28, 68, 29, 70, 27, 66, 30, 69)
");

echo "
<div style='font-family: Arial; max-width: 600px; margin: 50px auto; padding: 40px; background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);'>
    <h2 style='color: #28a745;'>✅ Database Setup Complete!</h2>
    <p>Database 'vit_results' created with sample student data.</p>
    <p><strong>Next Step:</strong> Run React app</p>
    <pre style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
cd q7
npm install
npm start
    </pre>
    <p><a href='api.php?id=1' style='color: #007bff;'>Test API →</a></p>
</div>";

$conn->close();
?>
