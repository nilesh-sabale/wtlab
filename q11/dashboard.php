<?php
require_once 'config.php';
require_once 'session_manager.php';

$sessionManager = new SessionManager();

if (!$sessionManager->isValidSession()) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$conn = getDBConnection();

// Get user info
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Get active sessions
$activeSessions = $sessionManager->getActiveSessions($userId);
$sessionCount = count($activeSessions);

// Calculate remaining time
$remainingTime = SESSION_TIMEOUT - (time() - $_SESSION['session_start']);
$remainingMinutes = floor($remainingTime / 60);
$remainingSeconds = $remainingTime % 60;

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Session Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        h1 {
            color: #333;
        }
        
        .logout-btn {
            padding: 10px 20px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .stat-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 32px;
            font-weight: bold;
        }
        
        .stat-label {
            font-size: 14px;
            margin-top: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #667eea;
            color: white;
        }
        
        .current {
            background: #e8f5e9;
        }
        
        .timer {
            background: #fff3cd;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        let remainingTime = <?php echo $remainingTime; ?>;
        
        // Check if session is still valid every 5 seconds
        setInterval(() => {
            fetch('check_session.php')
                .then(response => response.json())
                .then(data => {
                    if (!data.valid) {
                        alert('Your session has been terminated (max sessions exceeded)!');
                        window.location.href = 'logout.php';
                    }
                });
        }, 5000);
        
        setInterval(() => {
            remainingTime--;
            
            if (remainingTime <= 0) {
                alert('Session expired! Redirecting to login...');
                window.location.href = 'logout.php';
                return;
            }
            
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;
            
            document.getElementById('timer').innerHTML = 
                `⏱️ Session expires in: ${minutes}m ${seconds}s`;
        }, 1000);
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👋 Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
            <a href="logout.php"><button class="logout-btn">Logout</button></a>
        </div>
        
        <div class="timer" id="timer">
            ⏱️ Session expires in: <?php echo $remainingMinutes; ?>m <?php echo $remainingSeconds; ?>s
        </div>
        
        <div class="stats">
            <div class="stat-box">
                <div class="stat-value"><?php echo $sessionCount; ?></div>
                <div class="stat-label">Active Sessions</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?php echo MAX_SESSIONS; ?></div>
                <div class="stat-label">Max Allowed</div>
            </div>
            <div class="stat-box">
                <div class="stat-value"><?php echo SESSION_TIMEOUT / 60; ?>m</div>
                <div class="stat-label">Session Timeout</div>
            </div>
        </div>
        
        <div class="card">
            <h2>📋 Active Sessions</h2>
            <table>
                <thead>
                    <tr>
                        <th>Session ID</th>
                        <th>IP Address</th>
                        <th>Browser</th>
                        <th>Last Activity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activeSessions as $session): ?>
                        <?php $isCurrent = $session['session_id'] == session_id(); ?>
                        <tr class="<?php echo $isCurrent ? 'current' : ''; ?>">
                            <td><?php echo substr($session['session_id'], 0, 10); ?>...</td>
                            <td><?php echo htmlspecialchars($session['ip_address']); ?></td>
                            <td><?php echo substr($session['user_agent'], 0, 30); ?>...</td>
                            <td><?php echo $session['last_activity']; ?></td>
                            <td><?php echo $isCurrent ? '✅ Current' : '🔵 Active'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
