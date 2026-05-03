<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$prn = $data['prn'];
$department = 'Computer'; // Fixed as Computer
$semester = $data['semester'];
$course = 'Computer Engineering';

// Validate PRN (must be 8 digits)
if (!preg_match('/^\d{8}$/', $prn)) {
    echo json_encode(["success" => false, "message" => "PRN must be exactly 8 digits"]);
    exit;
}

// Insert new student with default marks (0)
$stmt = $conn->prepare("INSERT INTO students (name, prn, department, semester, course, subject1_mse, subject1_ese, subject2_mse, subject2_ese, subject3_mse, subject3_ese, subject4_mse, subject4_ese) VALUES (?, ?, ?, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0)");

$stmt->bind_param("sssis", $name, $prn, $department, $semester, $course);

if ($stmt->execute()) {
    $newId = $conn->insert_id;
    echo json_encode(["success" => true, "message" => "Student added successfully", "id" => $newId]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to add student: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
