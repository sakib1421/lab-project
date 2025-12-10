<?php
// db.php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'quiz_db';

// Create connection
$mysqli = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    die("DB connection failed: " . $mysqli->connect_error);
}
?>
