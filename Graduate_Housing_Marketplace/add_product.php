<?php
  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "Themagicalmysql#123";
  $dbname = "graduate_housing_marketplace";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  session_start();
  $seller_email = $_SESSION['user_id'];
  
  // Get seller id
  $sql = "SELECT Seller_id FROM Seller where Email = '$seller_email'";
  $result = mysqli_query($conn, $sql);
  $seller_id = mysqli_fetch_assoc($result);
    
  $seller_id_val = $seller_id['Seller_id'];
    
 
  // Get total product count for P_id 
  $sql = "SELECT count(*) as total_products FROM Product";
  $result = mysqli_query($conn, $sql);
  $total_products = mysqli_fetch_assoc($result);
    
  $product_count = $total_products['total_products'] + 1;
    
  // Get form data
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];


  // Insert data into table
  $query = "INSERT INTO Product (P_id, Title, Description, Price, Seller_id) VALUES ('$product_count', '$title', '$description', '$price', '$seller_id_val')";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  // Redirect back to form
  header('Location: add_product.html');
?>
