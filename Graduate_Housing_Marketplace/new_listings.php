<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "Themagicalmysql#123";
$dbname = "graduate_housing_marketplace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Query the database for new listings
$query = "SELECT * FROM product order by P_id desc limit 3";
$result = mysqli_query($conn, $query);

// Display the listings
while ($listing = mysqli_fetch_assoc($result)) {
  $title = $listing['Title'];
  echo '<form action="bid_product.php" method="post">';
  echo "<div class='listing small'>";
  echo "<h3>" . $title . "</h3>";
  echo "<input type='hidden' name='title' value='" . $title . "'>";
  //   echo "<img src='" . $listing['image'] . "' alt='Product Image'>";          
  echo "<p>" . $listing['Description'] . "</p>";
  // echo "<button>Buy Now</button>";
  echo "<input type='submit' value='Buy Now'>";
  echo "</div>";
  echo "</form>";
}

// Close the database connection
mysqli_close($conn);
?>
