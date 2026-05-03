<?php
$conn = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS q21_stud_db";
mysqli_query($conn, $sql);

mysqli_select_db($conn, 'q21_stud_db');

$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    course VARCHAR(50)
)";
mysqli_query($conn, $sql);

// Check if table is empty before inserting
$check = mysqli_query($conn, "SELECT COUNT(*) as count FROM students");
$row = mysqli_fetch_assoc($check);

if ($row['count'] == 0) {
    $sql = "INSERT INTO students (name, email, phone, course) VALUES 
        ('Nilesh Sabale', 'nilesh.sabale24@vit.edu', '7499244144', 'Computer Science'),
        ('Wasim Pathan', 'wasim.pathan24@vit.edu', '7488456515', 'Information Technology'),
        ('Shubham Gaikwad', 'shubham.gaikwad24@vit.edu', '7845129632', 'Electronics')";
    mysqli_query($conn, $sql);
}

echo "Database created with sample data!<br>";
echo "<a href='index.php'>Go to Students</a>";
?>
