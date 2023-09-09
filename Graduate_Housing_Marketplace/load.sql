USE graduate_housing_marketplace;

-- Sign_in 
-- // Check if the user's email and password match the values stored in the database
SELECT * FROM Authenticate WHERE Auth_id='$email' AND Password='$password';
SELECT * FROM Buyer WHERE Email='$email';
SELECT * FROM Seller WHERE Email='$email';

-- Sign_up 
-- // Check if the user's name, email and password match the values stored in the database
SELECT * FROM Authenticate WHERE Name = '$name' and Auth_id='$email' AND Password='$password';
-- // Save the user's sign-up details to the database and save into buyer or seller accordingly
INSERT INTO Authenticate (Name, Auth_id, Password) VALUES ('$name', '$email', '$password');
INSERT INTO Buyer (Buyer_id, Buyer_Name, Email, Address) VALUES ($buyer_count,'$name', '$email', '$address');
INSERT INTO Seller (Seller_id, Seller_Name, Email, Address) VALUES ($seller_count,'$name', '$email', '$address');

-- Featured listings
-- // Query the database for featured listings top 3
SELECT * FROM product order by P_id limit 3; 

-- New listings 
-- // Query the database for new listings latest 3
SELECT * FROM product order by P_id desc limit 3;

-- Browse page
-- // Query the database for all listings ordered by title
SELECT * FROM product order by Title;

-- Buyer account
-- // These are the currently bidded product details of the buyer
SELECT Product.Title, Product.Price, b.Bid_price from Product
            inner join
            (Select * from Bid
            where B_id in (
            Select Buyer_id from Buyer
            where Email = '$buyer_email')) as b
            on Product.P_id = b.P_id;
            
-- // Fetch the products bought from the database
SELECT * FROM Products_Bought 
		   where Buyer_id in (
		   Select Buyer_id from Buyer
		   where Email = '$buyer_email');
 
 -- // Insert new bid into database
INSERT INTO Bid (Bid_id, P_id, B_id, Bid_price) VALUES ('$bid_count', '$P_id_val', '$buyer_id_val', '$your_bid');

-- Seller_acount
-- // These are the products that are being bid for 
SELECT P_id, Title, Bid_price, Buyer_Name, Email, Price FROM
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
            on x.B_id = Buyer.Buyer_id; 
            
-- // These are the products that have been sold by the seller
SELECT * FROM Products_Bought 
		   where Seller_id in (
		   Select Seller_id from Seller
		   where Email = '$seller_email');
           
-- // Insert new product data into table
INSERT INTO Product (P_id, Title, Description, Price, Seller_id) VALUES ('$product_count', '$title', '$description', '$price', '$seller_id_val');

-- // Selling the product
INSERT INTO products_bought
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
    from Buyer limit 1) as z; 
  
	


         



