<?php
$conn = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS airplane_db";
mysqli_query($conn, $sql);

mysqli_select_db($conn, 'airplane_db');

$sql = "CREATE TABLE IF NOT EXISTS seats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seat_number VARCHAR(5) UNIQUE,
    passenger_name VARCHAR(100),
    status VARCHAR(20) DEFAULT 'available'
)";
mysqli_query($conn, $sql);

// Create 30 seats (5 rows x 6 columns: A-F)
$rows = 5;
$columns = ['A', 'B', 'C', 'D', 'E', 'F'];

for ($i = 1; $i <= $rows; $i++) {
    foreach ($columns as $col) {
        $seat = $i . $col;
        $sql = "INSERT IGNORE INTO seats (seat_number) VALUES ('$seat')";
        mysqli_query($conn, $sql);
    }
}

echo "Database and seats created!<br>";
echo "<a href='index.php'>Go to Booking</a>";
?>
