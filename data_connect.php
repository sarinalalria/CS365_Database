<?php
$servername = "208.109.23.206";
$username = "cs365";
$password = "cs365project";

// Create connection
$conn = new mysqli($servername, $username, $password,"cs365");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
		//echo "Connected successfully";
?>


