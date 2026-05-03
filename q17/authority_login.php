<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username == 'authority' && $password == 'auth123') {
        $_SESSION['authority'] = true;
        header('Location: authority_dashboard.php');
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Authority Login</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #ff9800; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #e68900; }
        .error { background: #f44336; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .info { background: #e3f2fd; padding: 10px; border-radius: 3px; margin-top: 10px; text-align: center; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #ff9800; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Authority Login</h2>
        
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
        
        <div class="info">Default: authority / auth123</div>
        
        <div class="link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
