<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    header("Location: index.php?error=Student not found");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $update = $conn->prepare("UPDATE students SET name = ?, email = ? WHERE id = ?");
    $update->bind_param("ssi", $name, $email, $id);
    
    if ($update->execute()) {
        header("Location: index.php?success=Student updated");
    } else {
        header("Location: index.php?error=Failed to update");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>✏️ Edit Student</h2>

<form method="POST">
    <label>ID:</label>
    <input type="text" value="<?php echo $student['id']; ?>" disabled>
    <small>ID cannot be changed</small>
    
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
    
    <button type="submit">Update</button>
    <a href="index.php" class="btn cancel">Cancel</a>
</form>

</div>
</body>
</html>
