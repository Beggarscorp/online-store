<?php
$servername = "localhost";
$username = "root";
$database="beggarsc_Backend_2";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username,$password,$database,3307);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
require("config.php");
// echo "Connected successfully";
?>