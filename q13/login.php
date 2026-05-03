<?php
session_start();
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            if ($remember) {
                setcookie('username', $username, time() + (86400 * 30), "/");
            }
            
            header('Location: home.php');
            exit();
        } else {
            $error = "Wrong password";
        }
    } else {
        $error = "User not found";
    }
}

$saved_username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #0b7dda; }
        .error { background: #f44336; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
    <h2>Login</h2>
    
    <?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
    
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo $saved_username; ?>" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <input type="checkbox" name="remember"> Remember me<br><br>
        
        <button type="submit">Login</button>
    </form>
    
    
    <div class="link">
        <a href="register.php">Don't have account? Register</a>
    </div>
    </div>
</body>
</html>
