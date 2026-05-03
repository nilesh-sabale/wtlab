<?php
session_start();

// Destroy session
session_unset();
session_destroy();

// Delete cookie
setcookie('username', '', time() - 3600, "/");

// Redirect to login
header('Location: index.php');
exit();
?>
