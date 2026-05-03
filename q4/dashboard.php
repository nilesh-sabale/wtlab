<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$login_time = $_SESSION['login_time'];
$cookie_exists = isset($_COOKIE['username']) ? 'Yes' : 'No';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lab 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="card-body">
                    <h4>Welcome, <?php echo htmlspecialchars($username); ?>!</h4>
                    
                    <div class="alert alert-success mt-3">
                        <h5>✅ Session-Based Login Working!</h5>
                        <p>You can see this page because a session exists with your login data.</p>
                    </div>

                    <h5 class="mt-4">Session Information:</h5>
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($username); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <th>Login Time</th>
                            <td><?php echo $login_time; ?></td>
                        </tr>
                        <tr>
                            <th>Session ID</th>
                            <td><?php echo session_id(); ?></td>
                        </tr>
                        <tr>
                            <th>Cookie Set</th>
                            <td><?php echo $cookie_exists; ?></td>
                        </tr>
                    </table>

                    <div class="alert alert-info">
                        <h6>🔒 How Session Protection Works:</h6>
                        <p>This page checks: <code>if (!isset($_SESSION['username']))</code></p>
                        <p>If session doesn't exist → Redirect to login</p>
                        <p>If session exists → Show this page</p>
                    </div>

                    <div class="mt-4">
                        <a href="logout.php" class="btn btn-danger">Logout (Destroy Session)</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
