<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    
    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
        exit();
    }
}

$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$student = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 20px; text-align: center; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #ff9800; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #e68900; }
        .back { display: block; text-align: center; margin-top: 15px; color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>
        
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
            
            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $student['phone']; ?>" required>
            
            <label>Course:</label>
            <select name="course" required>
                <option value="">Select Course</option>
                <option value="Computer Science" <?php echo $student['course'] == 'Computer Science' ? 'selected' : ''; ?>>Computer Science</option>
                <option value="Information Technology" <?php echo $student['course'] == 'Information Technology' ? 'selected' : ''; ?>>Information Technology</option>
                <option value="Electronics" <?php echo $student['course'] == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
                <option value="Mechanical" <?php echo $student['course'] == 'Mechanical' ? 'selected' : ''; ?>>Mechanical</option>
                <option value="Civil" <?php echo $student['course'] == 'Civil' ? 'selected' : ''; ?>>Civil</option>
            </select>
            
            <button type="submit">Update Student</button>
        </form>
        
        <a href="index.php" class="back">← Back to List</a>
    </div>
</body>
</html>
