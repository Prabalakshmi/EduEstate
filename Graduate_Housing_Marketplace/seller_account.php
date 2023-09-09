<!DOCTYPE html>
<html>
<head>
	<title>User Account</title>
	<link rel="stylesheet" href="seller_account.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>User Account</h1>
		<nav>
			<ul>
				<li><a href="add_product.html">Add Product</a></li>
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
            $seller_email = $_SESSION['user_id'];

            // Fetch the details of the Buyer from the database
            $result = mysqli_query($conn, "SELECT * FROM Seller where Email  = '$seller_email'");
            $seller_data = mysqli_fetch_assoc($result);

            

            echo '<h2>Seller Profile</h2>
            <div class="profile">
              <div class="info">
                <h3>Name: '.$seller_data['Seller_Name'].'</h3>
                <p>Email id: '.$seller_data['Email'].'</p>
                <p>Address: '.$seller_data['Address'].'</p>
              </div>
            </div>';

            $result = mysqli_query($conn, "SELECT P_id, Title, Bid_price, Buyer_Name, Email, Price FROM
            (SELECT a.P_id, B_id, Title, Bid_price, Price from
            (SELECT * from
            Product 
            where Seller_id in
            (SELECT Seller_id from
            Seller
            where Email = '$seller_email')) as a
            inner join Bid
            on a.P_id = Bid.P_id) as x
            inner join Buyer
            on x.B_id = Buyer.Buyer_id");

            // Display the products bidding currently in a table
            if (mysqli_num_rows($result) > 0) {
            echo "<section id='products_bid'>";
            echo "<h2>Products being Bid</h2>";
            echo "<table>";
            echo "<tr><th>Product Name</th><th>Bidding Price</th><th>Bidder's Name</th><th>Bidder's Email</th><th>Original Price</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row['Title']."</td><td>$".$row['Bid_price']."</td><td>$".$row['Buyer_Name']."</td><td>$".$row['Email']."</td><td>$".$row['Price'].'</td><td><form action="sold.php" method="post"><input type="hidden" name="P_id" value="'.$row['P_id'].'"><input type="hidden" name="Email" value="'.$row['Email'].'"><button type="submit">Sell</button></form></td></tr>"';
            }
            echo "</table>";
            echo "</section>";
            }
            
            // Fetch the products sold from the database
            $result = mysqli_query($conn, "SELECT * FROM Products_Bought 
                                           where Seller_id in (
                                           Select Seller_id from Seller
                                           where Email = '$seller_email')");

            // Display the products bought in a table
            if (mysqli_num_rows($result) > 0) {
                echo "<section id='products'>";
                echo "<h2>Products Sold</h2>";
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
