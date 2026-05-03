<?php
$conn = new mysqli("localhost", "root", "", "student_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("DROP TABLE IF EXISTS students");

$sql = "CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "
    <div style='font-family: Arial; max-width: 600px; margin: 50px auto; padding: 40px; background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);'>
        <h2 style='color: #28a745; margin-bottom: 20px;'>✅ Setup Successful!</h2>
        <p style='font-size: 16px; color: #666; margin-bottom: 20px;'>Database table created successfully!</p>
        <a href='index.php' style='display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600;'>Go to Student System →</a>
    </div>";
} else {
    echo "<div style='padding: 20px; color: red;'>Error: " . $conn->error . "</div>";
}

$conn->close();
?>
