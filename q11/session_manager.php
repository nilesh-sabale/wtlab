<?php
require_once 'config.php';

class SessionManager {
    private $conn;
    
    public function __construct() {
        $this->conn = getDBConnection();
        
        // Set session timeout BEFORE starting session
        ini_set('session.gc_maxlifetime', SESSION_TIMEOUT);
        session_set_cookie_params(SESSION_TIMEOUT);
        
        session_start();
    }
    
    // Create new session for user
    public function createSession($userId) {
        // Clean expired sessions first
        $this->cleanExpiredSessions();
        
        // Check current active sessions
        $activeSessions = $this->getActiveSessions($userId);
        
        if (count($activeSessions) >= MAX_SESSIONS) {
            // Remove oldest session
            $this->removeOldestSession($userId);
        }
        
        // Create new session record
        $sessionId = session_id();
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        
        $stmt = $this->conn->prepare("INSERT INTO user_sessions (user_id, session_id, ip_address, user_agent) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $sessionId, $ipAddress, $userAgent);
        $stmt->execute();
        $stmt->close();
        
        $_SESSION['user_id'] = $userId;
        $_SESSION['session_start'] = time();
    }
    
    // Get active sessions for user
    public function getActiveSessions($userId) {
        $timeout = time() - SESSION_TIMEOUT;
        
        $stmt = $this->conn->prepare("SELECT * FROM user_sessions WHERE user_id = ? AND UNIX_TIMESTAMP(last_activity) > ? ORDER BY last_activity DESC");
        $stmt->bind_param("ii", $userId, $timeout);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $sessions = [];
        while ($row = $result->fetch_assoc()) {
            $sessions[] = $row;
        }
        
        $stmt->close();
        return $sessions;
    }
    
    // Update session activity
    public function updateActivity() {
        if (isset($_SESSION['user_id'])) {
            $sessionId = session_id();
            $stmt = $this->conn->prepare("UPDATE user_sessions SET last_activity = CURRENT_TIMESTAMP WHERE session_id = ?");
            $stmt->bind_param("s", $sessionId);
            $stmt->execute();
            $stmt->close();
        }
    }
    
    // Check if session is valid
    public function isValidSession() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['session_start'])) {
            return false;
        }
        
        // Check timeout
        if (time() - $_SESSION['session_start'] > SESSION_TIMEOUT) {
            $this->destroySession();
            return false;
        }
        
        // Update last activity
        $this->updateActivity();
        $_SESSION['session_start'] = time();
        
        return true;
    }
    
    // Remove oldest session
    private function removeOldestSession($userId) {
        $stmt = $this->conn->prepare("DELETE FROM user_sessions WHERE user_id = ? ORDER BY last_activity ASC LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->close();
    }
    
    // Clean expired sessions
    public function cleanExpiredSessions() {
        $timeout = time() - SESSION_TIMEOUT;
        $stmt = $this->conn->prepare("DELETE FROM user_sessions WHERE UNIX_TIMESTAMP(last_activity) < ?");
        $stmt->bind_param("i", $timeout);
        $stmt->execute();
        $stmt->close();
    }
    
    // Destroy current session
    public function destroySession() {
        if (isset($_SESSION['user_id'])) {
            $sessionId = session_id();
            $stmt = $this->conn->prepare("DELETE FROM user_sessions WHERE session_id = ?");
            $stmt->bind_param("s", $sessionId);
            $stmt->execute();
            $stmt->close();
        }
        
        session_unset();
        session_destroy();
    }
    
    // Get session count
    public function getSessionCount($userId) {
        return count($this->getActiveSessions($userId));
    }
}
?>
