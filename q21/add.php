<?php
include 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    
    $sql = "INSERT INTO students (name, email, phone, course) VALUES ('$name', '$email', '$phone', '$course')";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .container { max-width: 500px; margin: 50px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; margin-bottom: 20px; text-align: center; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #45a049; }
        .back { display: block; text-align: center; margin-top: 15px; color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Student</h2>
        
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Phone:</label>
            <input type="text" name="phone" required>
            
            <label>Course:</label>
            <select name="course" required>
                <option value="">Select Course</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Electronics">Electronics</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Civil">Civil</option>
            </select>
            
            <button type="submit">Add Student</button>
        </form>
        
        <a href="index.php" class="back">← Back to List</a>
    </div>
</body>
</html>
