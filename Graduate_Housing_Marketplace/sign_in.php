<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "Themagicalmysql#123";
$dbname = "graduate_housing_marketplace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the user's email and password from the form
$email = $_POST["email"];
$password = $_POST["password"];
$selected_option = $_POST["options"];

// saving user data throughout the session
session_start();
$_SESSION['user_id'] = $email;

// Check if the user's email and password match the values stored in the database
$sql = "SELECT * FROM Authenticate WHERE Auth_id='$email' AND Password='$password'";
$result = mysqli_query($conn, $sql);

// If the user's credentials are correct, redirect them to the homepage
if (mysqli_num_rows($result) == 1) {
    if ($selected_option == 'buyer'){
      $sql = "SELECT * FROM Buyer WHERE Email='$email'";
      $result = mysqli_query($conn, $sql);
      
      if (mysqli_num_rows($result) == 1){
        header("Location: homepage.php");
        exit();
      } else {
        header("Location: sign_in.html");
        exit();
      }
    } else {
      $sql = "SELECT * FROM Seller WHERE Email='$email'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) == 1){
      header("Location: seller_account.php");
      exit();
      } else {
        header("Location: sign_in.html");
        exit();
      }
    }
  
} else {
  header("Location: sign_up.html");
  exit();
}

mysqli_close($conn);
?>
