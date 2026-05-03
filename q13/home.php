<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id=$user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        .user-info { background: #e3f2fd; padding: 20px; border-radius: 5px; margin: 20px 0; }
        .user-info p { margin: 10px 0; color: #555; }
        .user-info strong { color: #333; }
        .logout { display: inline-block; padding: 10px 20px; background: #f44336; color: white; text-decoration: none; border-radius: 3px; margin-top: 20px; }
        .logout:hover { background: #da190b; }
        .welcome { color: #2196F3; }
    </style>
</head>
<body>
    <div class="container">
    <h2 class="welcome">Welcome, <?php echo $user['username']; ?>!</h2>
    
    <p>You are logged in successfully.</p>
    
    <div class="user-info">
        <h3>Your Profile</h3>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Account Created:</strong> <?php echo date('F j, Y'); ?></p>
    </div>
    
    <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
