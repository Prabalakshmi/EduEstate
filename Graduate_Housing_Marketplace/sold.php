<?php
  // Connect to database and delete row
  $servername = "localhost";
  $username = "root";
  $password = "Themagicalmysql#123";
  $dbname = "graduate_housing_marketplace";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $P_id = $_POST['P_id'];
  $Email = $_POST['Email'];

  $sql = "SELECT count(*) as total_transactions FROM products_bought";
  $result = mysqli_query($conn, $sql);
  $total_transactions = mysqli_fetch_assoc($result);
    
  $transaction_count = $total_transactions['total_transactions'] + 1;

  $query = "INSERT INTO products_bought
  SELECT Transaction_id, Buyer_id, P_id, Title, Price, Seller_id 
  from
    (Select P_id, Title, Seller_id from Product
    where P_id = $P_id) as x
    cross join
    (SELECT b.B_id as Buyer_id, b.Bid_price as Price
    from 
    (Select * from Buyer
    where Email = '$Email') as a 
    inner join
    (Select * from Bid
    where P_id = $P_id) as b
    on a.Buyer_id = b.B_id) as y
    cross join
    (SELECT $transaction_count as Transaction_id
    from Buyer limit 1) as z";

  mysqli_query($conn, $query);

  $query = "DELETE FROM Bid WHERE P_id = $P_id";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  // Redirect back to table
  header('Location: seller_account.php');
?>
