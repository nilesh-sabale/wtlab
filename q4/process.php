<?php
session_start();

// Get form data from POST or GET
$name = isset($_POST['name']) ? $_POST['name'] : (isset($_GET['name']) ? $_GET['name'] : '');
$email = isset($_POST['email']) ? $_POST['email'] : (isset($_GET['email']) ? $_GET['email'] : '');
$password = isset($_POST['password']) ? $_POST['password'] : (isset($_GET['password']) ? $_GET['password'] : '');
$remember = (isset($_POST['remember']) || isset($_GET['remember'])) ? true : false;
$method = $_SERVER['REQUEST_METHOD'];

// ===== TASK 3: VALIDATE EMAIL FORMAT =====
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<div style='padding:20px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; margin:20px;'>";
    echo "<h3>❌ Email Validation Failed!</h3>";
    echo "<p><strong>Invalid Email:</strong> " . htmlspecialchars($email) . "</p>";
    echo "<p>Email must be in format: example@domain.com</p>";
    echo "<a href='index.php' style='color:#721c24;'>← Go Back</a>";
    echo "</div>";
    exit();
}

// Simple validation
if (!empty($name) && !empty($email) && !empty($password)) {
    
    // ===== TASK 5: SESSION-BASED LOGIN =====
    // Create session to store user data
    $_SESSION['username'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['login_time'] = date('Y-m-d H:i:s');
    $_SESSION['method'] = $method; // Store which method was used
    
    // ===== TASK 4: CREATE COOKIE =====
    // Store username in cookie if "Remember Me" is checked
    if ($remember) {
        setcookie('username', $name, time() + (86400 * 30), "/"); // 30 days
    }
    
    // Redirect to protected dashboard page
    header('Location: dashboard.php');
    exit();
    
} else {
    echo "<div style='padding:20px; background:#f8d7da; color:#721c24;'>";
    echo "❌ All fields are required! <a href='index.php'>Go Back</a>";
    echo "</div>";
}
?>
