<?php
include 'config.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $waste_type = $_POST['waste_type'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO waste_reports (name, location, waste_type, description) 
            VALUES ('$name', '$location', '$waste_type', '$description')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Waste report submitted successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Report Waste</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 30px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; text-align: center; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #45a049; }
        .success { background: #4CAF50; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #4CAF50; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Report Waste</h2>
        
        <?php if ($success) echo "<div class='success'>$success</div>"; ?>
        
        <form method="POST">
            <label>Your Name:</label>
            <input type="text" name="name" required>
            
            <label>Location:</label>
            <input type="text" name="location" placeholder="Enter exact location" required>
            
            <label>Waste Type:</label>
            <select name="waste_type" required>
                <option value="">Select Type</option>
                <option value="plastic">Plastic</option>
                <option value="paper">Paper</option>
                <option value="metal">Metal</option>
                <option value="organic">Organic</option>
                <option value="other">Other</option>
            </select>
            
            <label>Description:</label>
            <textarea name="description" rows="4" placeholder="Describe the waste"></textarea>
            
            <button type="submit">Submit Report</button>
        </form>
        
        <div class="link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
