<?php
include 'config.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $organization = $_POST['organization'];
    $complaint = $_POST['complaint'];
    
    $sql = "INSERT INTO complaints (name, email, organization, complaint) 
            VALUES ('$name', '$email', '$organization', '$complaint')";
    
    if (mysqli_query($conn, $sql)) {
        $success = "Complaint submitted successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Submit Complaint</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 30px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { color: #333; text-align: center; }
        label { display: block; margin: 10px 0 5px; color: #555; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2196F3; color: white; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #0b7dda; }
        .success { background: #4CAF50; color: white; padding: 10px; border-radius: 3px; margin-bottom: 10px; }
        .link { text-align: center; margin-top: 15px; }
        a { color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Complaint</h2>
        
        <?php if ($success) echo "<div class='success'>$success</div>"; ?>
        
        <form method="POST">
            <label>Your Name:</label>
            <input type="text" name="name" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Organization:</label>
            <select name="organization" required>
                <option value="">Select Organization</option>
                <option value="PMC">PMC (Pune Municipal Corporation)</option>
                <option value="PMT">PMT (Pune Mahanagar Transport)</option>
                <option value="Water Department">Water Department</option>
                <option value="Electricity Board">Electricity Board</option>
                <option value="Other">Other Institution</option>
            </select>
            
            <label>Complaint:</label>
            <textarea name="complaint" rows="5" placeholder="Describe your complaint" required></textarea>
            
            <button type="submit">Submit Complaint</button>
        </form>
        
        <div class="link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
