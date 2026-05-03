<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lab11_session_db');

// Session configuration
define('MAX_SESSIONS', 3);           // Maximum concurrent sessions per user
define('SESSION_TIMEOUT', 300);      // 5 minutes in seconds (5 * 60)

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>
