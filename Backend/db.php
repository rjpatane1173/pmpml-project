<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "pmpml_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
