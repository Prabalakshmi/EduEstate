<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "Themagicalmysql#123";
$dbname = "graduate_housing_marketplace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Query the database for featured listings
$query = "SELECT * FROM product order by P_id limit 3";
$result = mysqli_query($conn, $query);

// Display the listings
while ($listing = mysqli_fetch_assoc($result)) {
  $title = $listing['Title'];
  echo '<form action="bid_product.php" method="post">';
  echo "<div class='listing'>";
  echo "<h3>" . $title . "</h3>";
  echo "<input type='hidden' name='title' value='" . $title . "'>";      
  echo "<p>" . $listing['Description'] . "</p>";
  echo "<input type='submit' value='Buy Now'>";
  echo "</div>";
  echo "</form>";
}

// Close the database connection
mysqli_close($conn);
?>
