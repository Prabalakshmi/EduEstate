<!DOCTYPE html>
<html>
<head>
  <title>Bid on Product</title>
  <link rel="stylesheet" href="bid_product.css">
</head>
<body>
  <h1>Bid on Product</h1>
  <?php
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "Themagicalmysql#123";
    $dbname = "graduate_housing_marketplace";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Get product name from database
    $title = $_POST["title"];

    

    $query = "SELECT Price FROM product WHERE title = '$title'";
    $result = mysqli_query($conn, $query);
    $product_price = mysqli_fetch_assoc($result)['Price'];

    mysqli_close($conn);
  ?>
  <form action="bid_product_final.php" method="post">
    <label for="name">Product Name:</label>
    <input type="text" name="name" id="name" value="<?php echo $title; ?>" readonly><br>
    <label for="original_price">Original Price:</label>
    <input type="number" name="original_price" id="original_price" value="<?php echo $product_price; ?>" readonly><br>
    <label for="your_bid">Your Bid:</label>
    <input type="number" name="your_bid" id="your_bid" step="0.01" required><br>
    <button type="submit">Place Bid</button>
  </form>
  <form action="buyer_account.php" method="post">
    <button type="submit">Account</button>
  </form>
</body>
</html>
