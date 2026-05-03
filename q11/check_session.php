<?php
require_once 'config.php';
session_start();

header('Content-Type: application/json');

$valid = false;

if (isset($_SESSION['user_id'])) {
    $sessionId = session_id();
    $conn = getDBConnection();
    
    // Check if session exists in database
    $stmt = $conn->prepare("SELECT id FROM user_sessions WHERE session_id = ?");
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $valid = $result->num_rows > 0;
    
    $stmt->close();
    $conn->close();
}

echo json_encode(['valid' => $valid]);
?>
