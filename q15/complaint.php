<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: student_login.php');
    exit();
}

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['student_id'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO complaints (student_id, subject, description) VALUES ($student_id, '$subject', '$description')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Complaint submitted successfully!";
    }
}

$student_id = $_SESSION['student_id'];
$sql = "SELECT * FROM complaints WHERE student_id=$student_id ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Complaint</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 20px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2, h3 { color: #333; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { padding: 12px 30px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background: #0b7dda; }
        .success { background: #4CAF50; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #2196F3; color: white; }
        tr:hover { background: #f5f5f5; }
        .status-resolved { color: #4CAF50; font-weight: bold; }
        .status-pending { color: #ff9800; font-weight: bold; }
        .logout { display: inline-block; padding: 10px 20px; background: #f44336; color: white; text-decoration: none; border-radius: 3px; margin-top: 10px; }
        hr { margin: 30px 0; border: none; border-top: 2px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
    <h2>Welcome, <?php echo $_SESSION['student_name']; ?></h2>
    
    <?php if ($success) echo "<p style='color:green'>$success</p>"; ?>
    
    <h3>Submit New Complaint</h3>
    <form method="POST">
        <label>Subject:</label><br>
        <input type="text" name="subject" required><br><br>
        
        <label>Description:</label><br>
        <textarea name="description" rows="5" cols="40" required></textarea><br><br>
        
        <button type="submit">Submit Complaint</button>
    </form>
    
    <hr>
    
    <h3>My Complaints</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td class="status-<?php echo $row['status']; ?>">
                <?php echo ucfirst($row['status']); ?>
            </td>
            <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    
    
    <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
