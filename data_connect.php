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

//Gonna put all the triggers and procedures in here so they'll run everytime a page is booted up
		//echo "Connected successfully";
?>


