<?php
include 'config.php';

$message = '';

// Delete student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    $message = "Student deleted!";
}

// Get all students
$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; text-align: center; }
        .message { background: #4CAF50; color: white; padding: 12px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
        .add-btn { display: inline-block; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .add-btn:hover { background: #45a049; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #2196F3; color: white; }
        tr:hover { background: #f5f5f5; }
        .actions a { display: inline-block; padding: 6px 12px; margin: 0 5px; text-decoration: none; border-radius: 3px; color: white; }
        .edit { background: #ff9800; }
        .edit:hover { background: #e68900; }
        .delete { background: #f44336; }
        .delete:hover { background: #da190b; }
        
        @media (max-width: 768px) {
            .container { padding: 15px; }
            table { font-size: 14px; }
            th, td { padding: 8px; }
            .actions a { padding: 4px 8px; font-size: 12px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Student Records</h1>
        
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        
        <a href="add.php" class="add-btn">+ Add New Student</a>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td class="actions">
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
                    <a href="?delete=<?php echo $row['id']; ?>" class="delete" onclick="return confirm('Delete this student?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
