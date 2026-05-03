<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>📚 Add New Student</h2>

<?php
if (isset($_GET['error'])) {
    echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>";
}
if (isset($_GET['success'])) {
    echo "<div class='success'>" . htmlspecialchars($_GET['success']) . "</div>";
}
?>

<form action="add.php" method="POST">
    <label>ID:</label>
    <input type="number" name="id" min="1" required>
    <small>Enter unique ID number</small>
    
    <label>Name:</label>
    <input type="text" name="name" required>
    
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <button type="submit">Add Student</button>
</form>

<hr>

<h2>👥 Student List</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM students ORDER BY id");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>
                <a href='edit.php?id={$row['id']}' class='btn edit'>Edit</a> |
                <a href='delete.php?id={$row['id']}'
                class='btn delete'
                onclick=\"return confirm('Delete this student?')\">Delete</a>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4' style='text-align:center;'>No students found</td></tr>";
}
?>

</table>

</div>
</body>
</html>
