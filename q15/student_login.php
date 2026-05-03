<?php
session_start();
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['student_name'] = $student['name'];
            header('Location: complaint.php');
            exit();
        } else {
            $error = "Wrong password";
        }
    } else {
        $error = "Student not found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #0b7dda; }
        .error { background: #f44336; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
    <h2>Student Login</h2>
    
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    
    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    
    
    <div class="link">
        <a href="student_register.php">Register</a> | 
        <a href="index.php">Back</a>
    </div>
    </div>
</body>
</html>
