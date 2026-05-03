<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$marks = $data['marks'];

// Update marks in database
$stmt = $conn->prepare("UPDATE students SET 
    subject1_mse = ?, subject1_ese = ?,
    subject2_mse = ?, subject2_ese = ?,
    subject3_mse = ?, subject3_ese = ?,
    subject4_mse = ?, subject4_ese = ?
    WHERE name = ?");

$stmt->bind_param("iiiiiiiis", 
    $marks[0]['mse'], $marks[0]['ese'],
    $marks[1]['mse'], $marks[1]['ese'],
    $marks[2]['mse'], $marks[2]['ese'],
    $marks[3]['mse'], $marks[3]['ese'],
    $name
);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Marks updated"]);
} else {
    echo json_encode(["success" => false, "message" => "Update failed"]);
}

$stmt->close();
$conn->close();
?>
