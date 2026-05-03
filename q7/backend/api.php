<?php
include 'db.php';

$id = isset($_GET['id']) ? $_GET['id'] : 1;

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
    echo json_encode($student);
} else {
    echo json_encode(["error" => "Student not found"]);
}

$stmt->close();
$conn->close();
?>
