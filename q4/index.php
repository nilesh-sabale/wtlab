<?php
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

// Check for cookie
$remembered_user = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Lab 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Login Form</h3>
                </div>
                <div class="card-body">
                    
                    <!-- POST Method Form -->
                    <h5>POST Method</h5>
                    <form action="process.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $remembered_user; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login (POST)</button>
                    </form>

                    <hr>

                    <!-- GET Method Form -->
                    <h5>GET Method</h5>
                    <form action="process.php" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="rememberGet">
                            <label class="form-check-label" for="rememberGet">Remember Me</label>
                        </div>
                        <button type="submit" class="btn btn-secondary w-100">Login (GET)</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<!-- # Lab 4 - PHP Form Processing, Sessions & Cookies

## Features Implemented:

1. ✅ HTML form with Name, Email, Password
2. ✅ Process form using GET and POST methods
3. ✅ Validate email format using `filter_var()`
4. ✅ Create cookie to store username (30 days)
5. ✅ Session-based login system

## Files:

- `index.php` - Login form (GET & POST methods)
- `process.php` - Form processing & validation
- `dashboard.php` - Protected dashboard page
- `logout.php` - Session & cookie cleanup

## How to Run:

1. Install XAMPP/WAMP/MAMP
2. Copy `q4` folder to `htdocs` directory
3. Start Apache server
4. Open browser: `http://localhost/LAB2/q4/index.php`

## Test Credentials:

- Name: Any name
- Email: Valid email format (e.g., test@example.com)
- Password: Any password

## Features:

- **POST Method**: Secure form submission (data not visible in URL)
- **GET Method**: Data visible in URL (for demonstration)
- **Email Validation**: Server-side validation using PHP
- **Session Management**: User data stored in session
- **Cookie**: "Remember Me" stores username for 30 days
- **Protected Pages**: Dashboard accessible only after login
 -->