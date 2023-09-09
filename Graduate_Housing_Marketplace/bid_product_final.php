<?php
  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "Themagicalmysql#123";
  $dbname = "graduate_housing_marketplace";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Get form data
  $name = $_POST['name'];
  $original_price = $_POST['original_price'];
  $your_bid = $_POST['your_bid'];

  session_start();
  $buyer_email = $_SESSION['user_id'];
  
  // Get Buyer id
  $sql = "SELECT Buyer_id FROM Buyer where Email = '$buyer_email'";
  $result = mysqli_query($conn, $sql);
  $buyer_id = mysqli_fetch_assoc($result);
    
  $buyer_id_val = $buyer_id['Buyer_id'];

  // Get total bid count 
  $sql = "SELECT Bid_id as total_bids FROM Bid order by Bid_id desc limit 1";
  $result = mysqli_query($conn, $sql);
  $total_bids = mysqli_fetch_assoc($result);
    
  $bid_count = $total_bids['total_bids'] + 1;

  echo $bid_count;
  // Get Product id
  $sql = "SELECT P_id FROM Product where Title = '$name'";
  $result = mysqli_query($conn, $sql);
  $P_id = mysqli_fetch_assoc($result);
    
  $P_id_val = $P_id['P_id'];

  // Insert new bid into database
  $query = "INSERT INTO Bid (Bid_id, P_id, B_id, Bid_price) VALUES ('$bid_count', '$P_id_val', '$buyer_id_val', '$your_bid')";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  // Redirect back to form
  header('Location: browse.php');
?>
