<!DOCTYPE html>
<html>
<head>
    <title>Attendance System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 400px;
        }
        
        h1 {
            margin-bottom: 30px;
            color: #333;
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .btn:hover {
            background: #5568d3;
        }
        
        .btn-secondary {
            background: #28a745;
        }
        
        .btn-secondary:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Attendance System</h1>
        <a href="student_register.php" class="btn">Student Registration</a>
        <a href="teacher_login.php" class="btn btn-secondary">Teacher Login</a>
    </div>
</body>
</html>
