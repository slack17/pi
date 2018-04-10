<?php
$servername = "localhost";
$username = "khaled";
$password = "test123";
$dbname = "phpauto";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



?>