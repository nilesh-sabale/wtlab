<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include 'db.php';

$result = $conn->query("SELECT id, name, prn, semester FROM students ORDER BY id");

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode(["students" => $students]);

$conn->close();
?>
