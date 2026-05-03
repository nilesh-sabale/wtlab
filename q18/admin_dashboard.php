<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit();
}

$message = '';

if (isset($_POST['update_status'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'status_') === 0) {
            $id = str_replace('status_', '', $key);
            $status = isset($_POST['resolved_' . $id]) ? 'resolved' : 'pending';
            $sql = "UPDATE complaints SET status='$status' WHERE id=$id";
            mysqli_query($conn, $sql);
        }
    }
    $message = "Status updated!";
}

$sql = "SELECT * FROM complaints ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        .success { background: #4CAF50; color: white; padding: 12px; border-radius: 3px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #ff9800; color: white; }
        tr:hover { background: #f5f5f5; }
        .status-resolved { color: #4CAF50; font-weight: bold; }
        .status-pending { color: #ff9800; font-weight: bold; }
        .checkbox { width: 20px; height: 20px; cursor: pointer; }
        .save-btn { padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 20px; }
        .save-btn:hover { background: #45a049; }
        .logout { display: inline-block; padding: 10px 20px; background: #f44336; color: white; text-decoration: none; border-radius: 3px; float: right; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard - All Complaints</h2>
        <a href="logout.php" class="logout">Logout</a>
        <div style="clear:both"></div>
        
        <?php if ($message): ?>
            <div class="success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Organization</th>
                <th>Complaint</th>
                <th>Status</th>
                <th>Date</th>
                <th>Resolved</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['organization']; ?></td>
                <td><?php echo $row['complaint']; ?></td>
                <td class="status-<?php echo $row['status']; ?>">
                    <?php echo ucfirst($row['status']); ?>
                </td>
                <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
                <td>
                    <input type="hidden" name="status_<?php echo $row['id']; ?>" value="1">
                    <input type="checkbox" 
                           name="resolved_<?php echo $row['id']; ?>" 
                           class="checkbox"
                           <?php echo $row['status'] == 'resolved' ? 'checked' : ''; ?>>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <button type="submit" name="update_status" class="save-btn">Save Changes</button>
        </form>
    </div>
</body>
</html>
