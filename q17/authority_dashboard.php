<?php
session_start();
include 'config.php';

if (!isset($_SESSION['authority'])) {
    header('Location: authority_login.php');
    exit();
}

$message = '';

if (isset($_POST['update_status'])) {
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'status_') === 0) {
            $id = str_replace('status_', '', $key);
            $status = isset($_POST['collected_' . $id]) ? 'collected' : 'pending';
            $sql = "UPDATE waste_reports SET status='$status' WHERE id=$id";
            mysqli_query($conn, $sql);
        }
    }
    $message = "Status updated!";
}

$sql = "SELECT * FROM waste_reports ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Authority Dashboard</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 1200px; margin: 20px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; }
        .success { background: #4CAF50; color: white; padding: 12px; border-radius: 3px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #ff9800; color: white; }
        tr:hover { background: #f5f5f5; }
        .status-collected { color: #4CAF50; font-weight: bold; }
        .status-pending { color: #ff9800; font-weight: bold; }
        .checkbox { width: 20px; height: 20px; cursor: pointer; }
        .save-btn { padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 20px; }
        .save-btn:hover { background: #45a049; }
        .logout { display: inline-block; padding: 10px 20px; background: #f44336; color: white; text-decoration: none; border-radius: 3px; float: right; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Authority Dashboard - Waste Reports</h2>
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
                <th>Location</th>
                <th>Waste Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
                <th>Collected</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo ucfirst($row['waste_type']); ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="status-<?php echo $row['status']; ?>">
                    <?php echo ucfirst($row['status']); ?>
                </td>
                <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
                <td>
                    <input type="hidden" name="status_<?php echo $row['id']; ?>" value="1">
                    <input type="checkbox" 
                           name="collected_<?php echo $row['id']; ?>" 
                           class="checkbox"
                           <?php echo $row['status'] == 'collected' ? 'checked' : ''; ?>>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <button type="submit" name="update_status" class="save-btn">Save Changes</button>
        </form>
    </div>
</body>
</html>
