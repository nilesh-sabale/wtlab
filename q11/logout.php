<?php
require_once 'session_manager.php';

$sessionManager = new SessionManager();
$sessionManager->destroySession();

header('Location: login.php');
exit();
?>
