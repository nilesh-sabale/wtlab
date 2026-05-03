<?php
include 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$hashed')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Registration successful!";
    } else {
        $error = "Email already exists";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Register</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #45a049; }
        .error { background: #f44336; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .success { background: #4CAF50; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
    <h2>Student Registration</h2>
    
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
    
    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
    
    
    <div class="link">
        <a href="student_login.php">Login</a>
    </div>
    </div>
</body>
</html>
