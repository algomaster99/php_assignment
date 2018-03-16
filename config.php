<?php
$servername = "192.168.121.187";
$username = "first_year";
$password = "first_year";
$db = "first_year_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}
?> 
