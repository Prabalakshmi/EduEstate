<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Products</title>
  <link rel="stylesheet" href="homepage.css">
</head>

<body>
    <header>
    <h1>Welcome to the Marketplace!</h1>
    <nav>
        <ul>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="buyer_account.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    </header>
    <section>
        <h2>All Listings</h2>
        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "Themagicalmysql#123";
        $dbname = "graduate_housing_marketplace";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Query the database for all listings
        $query = "SELECT * FROM product order by Title";
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
    </section>
</body>
</html>
