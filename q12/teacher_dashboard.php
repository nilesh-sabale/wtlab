<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['teacher_id'])) {
    header('Location: teacher_login.php');
    exit();
}

$conn = getDBConnection();

// Get selected date or use today
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$message = '';

// Handle clear attendance
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clear_attendance'])) {
    $dateToDelete = $_POST['date_to_clear'];
    $stmt = $conn->prepare("DELETE FROM attendance WHERE date = ?");
    $stmt->bind_param("s", $dateToDelete);
    $stmt->execute();
    $stmt->close();
    $message = "Attendance cleared successfully!";
}

// Handle attendance submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendance'])) {
    $attendance = $_POST['attendance'];
    $dateToMark = $_POST['date_to_mark'];
    
    foreach ($attendance as $studentId => $status) {
        $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?) 
                               ON DUPLICATE KEY UPDATE status = ?, marked_at = CURRENT_TIMESTAMP");
        $stmt->bind_param("isss", $studentId, $dateToMark, $status, $status);
        $stmt->execute();
        $stmt->close();
    }
    
    $message = "Attendance marked successfully for " . date('M j, Y', strtotime($dateToMark)) . "!";
    $selectedDate = $dateToMark;
}

// Get all students
$students = [];
$result = $conn->query("SELECT * FROM students ORDER BY roll_no");
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Get attendance for selected date
$attendanceData = [];
$attendanceMarkedAt = null;
$stmt = $conn->prepare("SELECT student_id, status, marked_at FROM attendance WHERE date = ?");
$stmt->bind_param("s", $selectedDate);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $attendanceData[$row['student_id']] = $row['status'];
    if (!$attendanceMarkedAt) {
        $attendanceMarkedAt = $row['marked_at'];
    }
}
$stmt->close();

// Get attendance history (last 7 days)
$historyQuery = "SELECT a.date, s.roll_no, s.name, a.status, a.marked_at 
                 FROM attendance a 
                 JOIN students s ON a.student_id = s.id 
                 WHERE a.date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                 ORDER BY a.date DESC, s.roll_no";
$historyResult = $conn->query($historyQuery);
$attendanceHistory = [];
while ($row = $historyResult->fetch_assoc()) {
    $attendanceHistory[] = $row;
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
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
            max-width: 900px;
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
            text-decoration: none;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #667eea;
            color: white;
        }
        
        tr:hover {
            background: #f5f5f5;
        }
        
        .checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        
        .submit-btn {
            width: 100%;
            padding: 15px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        
        .submit-btn:hover {
            background: #218838;
        }
        
        .message {
            background: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .date-info {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .already-marked {
            background: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #ffc107;
        }
        
        .clear-btn {
            padding: 10px 20px;
            background: #ff9800;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        
        .clear-btn:hover {
            background: #e68900;
        }
        
        .history-section {
            margin-top: 30px;
        }
        
        .present {
            color: #4caf50;
            font-weight: bold;
        }
        
        .absent {
            color: #f44336;
            font-weight: bold;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .button-group button {
            flex: 1;
        }
        
        .date-selector {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .date-selector input[type="date"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .date-selector button {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .date-selector button:hover {
            background: #5568d3;
        }
        
        .today-btn {
            background: #28a745 !important;
        }
        
        .today-btn:hover {
            background: #218838 !important;
        }
        
        .date-separator {
            background: #667eea;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👨‍🏫 Teacher Dashboard</h1>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <!-- Date Selector -->
        <div class="date-selector">
            <label><strong>Select Date:</strong></label>
            <form method="GET" style="display: flex; gap: 10px; align-items: center; flex: 1;">
                <input type="date" name="date" value="<?php echo $selectedDate; ?>" required>
                <button type="submit">Load Attendance</button>
                <button type="button" class="today-btn" onclick="window.location.href='teacher_dashboard.php'">Today</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Mark Attendance</h2>
            <div class="date-info">
                📅 Date: <?php echo date('l, F j, Y', strtotime($selectedDate)); ?>
            </div>
            
            <?php if ($attendanceMarkedAt): ?>
                <div class="already-marked">
                    ⚠️ Attendance already marked for this date at <?php echo date('h:i A', strtotime($attendanceMarkedAt)); ?>
                    <br>You can update it by marking again.
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <input type="hidden" name="date_to_mark" value="<?php echo $selectedDate; ?>">
                <table>
                    <thead>
                        <tr>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Present</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <?php 
                                $isPresent = isset($attendanceData[$student['id']]) && 
                                           $attendanceData[$student['id']] == 'present';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['roll_no']); ?></td>
                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                                <td>
                                    <input type="hidden" 
                                           name="attendance[<?php echo $student['id']; ?>]" 
                                           value="absent">
                                    <input type="checkbox" 
                                           name="attendance[<?php echo $student['id']; ?>]" 
                                           value="present" 
                                           class="checkbox"
                                           <?php echo $isPresent ? 'checked' : ''; ?>>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="button-group">
                    <button type="submit" class="submit-btn">Save Attendance</button>
                </div>
            </form>
            
            <?php if ($attendanceMarkedAt): ?>
                <form method="POST" style="margin-top: 10px;">
                    <input type="hidden" name="date_to_clear" value="<?php echo $selectedDate; ?>">
                    <button type="submit" name="clear_attendance" class="clear-btn" 
                            onclick="return confirm('Are you sure you want to clear attendance for <?php echo date('M j, Y', strtotime($selectedDate)); ?>?')">
                        Clear This Date's Attendance
                    </button>
                </form>
            <?php endif; ?>
        </div>
        
        <!-- Attendance History -->
        <div class="card history-section">
            <h2>📊 Attendance History (Last 7 Days)</h2>
            
            <?php if (count($attendanceHistory) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Marked At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $lastDate = null;
                        foreach ($attendanceHistory as $record): 
                            // Add separator row when date changes
                            if ($lastDate !== null && $lastDate !== $record['date']): 
                        ?>
                            <tr>
                                <td colspan="5" class="date-separator">
                                    <?php echo date('l, F j, Y', strtotime($record['date'])); ?>
                                </td>
                            </tr>
                        <?php 
                            elseif ($lastDate === null):
                        ?>
                            <tr>
                                <td colspan="5" class="date-separator">
                                    <?php echo date('l, F j, Y', strtotime($record['date'])); ?>
                                </td>
                            </tr>
                        <?php 
                            endif;
                            $lastDate = $record['date'];
                        ?>
                            <tr>
                                <td><?php echo date('M j, Y', strtotime($record['date'])); ?></td>
                                <td><?php echo htmlspecialchars($record['roll_no']); ?></td>
                                <td><?php echo htmlspecialchars($record['name']); ?></td>
                                <td class="<?php echo $record['status']; ?>">
                                    <?php echo $record['status'] == 'present' ? '✓ Present' : '✗ Absent'; ?>
                                </td>
                                <td><?php echo date('h:i A', strtotime($record['marked_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; padding: 20px; color: #999;">No attendance records found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
