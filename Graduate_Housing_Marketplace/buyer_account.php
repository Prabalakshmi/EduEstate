<!DOCTYPE html>
<html>
<head>
	<title>User Account</title>
	<link rel="stylesheet" href="buyer_account.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>User Account</h1>
		<nav>
			<ul>
				<li><a href="homepage.php">Home</a></li>
        <li><a href="browse.php">Browse</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
        </header>
        
		<main>
			<?php
            // Include the database configuration file
            require_once 'config.php';

            // using saved user data throughout the session
            session_start();
            $buyer_email = $_SESSION['user_id'];

            // Fetch the details of the Buyer from the database
            $result = mysqli_query($conn, "SELECT * FROM Buyer where Email  = '$buyer_email'");
            $buyer_data = mysqli_fetch_assoc($result);

            

            echo '<h2>Buyer Profile</h2>
            <div class="profile">
              <div class="info">
                <h3>Name: '.$buyer_data['Buyer_Name'].'</h3>
                <p>Email id: '.$buyer_data['Email'].'</p>
                <p>Address: '.$buyer_data['Address'].'</p>
              </div>
            </div>';

            // Fetch the bidded products
            $result = mysqli_query($conn, "SELECT Product.Title, Product.Price, b.Bid_price from Product
            inner join
            (Select * from Bid
            where B_id in (
            Select Buyer_id from Buyer
            where Email = '$buyer_email')) as b
            on Product.P_id = b.P_id");

            // Display the products bidded for in a table
            if (mysqli_num_rows($result) > 0) {
            echo "<section id='products_bid'>";
            echo "<h2>Products Bidding for</h2>";
            echo "<table>";
            echo "<tr><th>Product Name</th><th>Bidding Price</th><th>Original Price</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row['Title']."</td><td>$".$row['Bid_price']."</td><td>$".$row['Price']."</td></tr>";
            }
            echo "</table>";
            echo "</section>";
            }
            
            // Fetch the products bought from the database
            $result = mysqli_query($conn, "SELECT * FROM Products_Bought 
                                           where Buyer_id in (
                                           Select Buyer_id from Buyer
                                           where Email = '$buyer_email')");

            // Display the products bought in a table
            if (mysqli_num_rows($result) > 0) {
                echo "<section id='products'>";
                echo "<h2>Products Bought</h2>";
                echo "<table>";
                echo "<tr><th>Product Name</th><th>Price</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row['Title']."</td><td>$".$row['Price']."</td></tr>";
                }
                echo "</table>";
                echo "</section>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
		</main>
		<footer>
			<p>&copy; 2023 Marketplace</p>
		</footer>
	</div>
</body>
</html>
