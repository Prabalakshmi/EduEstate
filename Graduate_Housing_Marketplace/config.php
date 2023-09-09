<?php
$servername = "localhost";
$username = "root";
$password = "Themagicalmysql#123";
$dbname = "graduate_housing_marketplace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>
