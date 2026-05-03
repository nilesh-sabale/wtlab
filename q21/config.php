<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'q21_stud_db';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed");
}
?>
