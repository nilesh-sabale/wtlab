<?php
include 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Check if ID already exists
$check = $conn->prepare("SELECT id FROM students WHERE id = ?");
$check->bind_param("i", $id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    header("Location: index.php?error=ID $id already exists! Please use a different ID.");
    exit();
}

// Insert new student
$stmt = $conn->prepare("INSERT INTO students (id, name, email) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $id, $name, $email);

if ($stmt->execute()) {
    header("Location: index.php?success=Student added successfully with ID: $id");
} else {
    header("Location: index.php?error=Failed to add student");
}

$stmt->close();
$conn->close();
?>
