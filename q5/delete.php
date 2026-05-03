<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?success=Student deleted");
} else {
    header("Location: index.php?error=Failed to delete");
}

$stmt->close();
$conn->close();
?>
