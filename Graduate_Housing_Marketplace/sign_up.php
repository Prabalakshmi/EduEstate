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

// Get the user's name, email, and password from the form
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$address = $_POST["address"];
$selected_option = $_POST["options"]; 

// saving user data throughout the session
session_start();
$_SESSION['user_id'] = $email;

// Check if the user's name, email and password match the values stored in the database
$sql = "SELECT * FROM Authenticate WHERE Name = '$name' and Auth_id='$email' AND Password='$password'";
$result = mysqli_query($conn, $sql);

// If the user's credentials are correct, redirect them to the homepage
if (mysqli_num_rows($result) == 1) {
    // echo "Valid credentials.";
  echo "User already exists!!";
  header("Location: sign_in.html");
  exit();
} else {
  // Save the user's sign-up details to the database
  $sql = "INSERT INTO Authenticate (Name, Auth_id, Password) VALUES ('$name', '$email', '$password')";
  mysqli_query($conn, $sql);


  if ($selected_option == 'buyer'){

    $sql = "SELECT count(*) as total_buyers FROM Buyer";
    $result = mysqli_query($conn, $sql);
    $total_buyers = mysqli_fetch_assoc($result);

    $buyer_count = $total_buyers['total_buyers'] + 1;
    
    
    $sql = "INSERT INTO Buyer (Buyer_id, Buyer_Name, Email, Address) VALUES ($buyer_count,'$name', '$email', '$address')";
    mysqli_query($conn, $sql);
    
    // $sql = "SELECT * FROM Buyer WHERE Email='$email'";
    // $result = mysqli_query($conn, $sql);

    header("Location: homepage.php");
    exit();

  } else {

    $sql = "SELECT count(*) as total_sellers FROM Seller";
    $result = mysqli_query($conn, $sql);
    $total_sellers = mysqli_fetch_assoc($result);
    
    $seller_count = $total_sellers['total_sellers'] + 1;
    
    $sql = "INSERT INTO Seller (Seller_id, Seller_Name, Email, Address) VALUES ($seller_count,'$name', '$email', '$address')";
    mysqli_query($conn, $sql);

    // $sql = "SELECT * FROM Seller WHERE Email='$email'";
    // $result = mysqli_query($conn, $sql);

    header("Location: seller_account.php");
    exit();

  }
}

mysqli_close($conn);
?>
