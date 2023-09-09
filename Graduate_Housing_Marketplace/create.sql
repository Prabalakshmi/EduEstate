CREATE DATABASE IF NOT EXISTS graduate_housing_marketplace;

USE graduate_housing_marketplace;

CREATE TABLE IF NOT EXISTS Buyer(
	Buyer_id INT NOT NULL UNIQUE, 
	Buyer_Name VARCHAR(20) NOT NULL,
	Email VARCHAR(25),
	Address VARCHAR(50),
	PRIMARY KEY(Buyer_id)
);

INSERT INTO 
	Buyer(Buyer_id, Buyer_Name, Email, Address)
VALUES
	(1, 'person1', 'person1@gradmarket.com', '123 Main St, Anytown'),
    (2, 'person2', 'person2@gradmarket.com', '456 Oak St, Anytown'),
    (3, 'person3', 'person3@gradmarket.com', '789 Elm St, Anytown'),
    (4, 'person6', 'person6@gradmarket.com', '321 Pine St, Anytown'),
    (5, 'person7', 'person7@gradmarket.com', '654 Maple St, Anytown'),
    (6, 'person8', 'person8@gradmarket.com', '987 Cedar St, Anytown'),
    (7, 'person11', 'person11@gradmarket.com', '246 Birch St, Anytown'),
    (8, 'person12', 'person12@gradmarket.com', '135 Walnut St, Anytown'),
    (9, 'person13', 'person13@gradmarket.com', '802 Oakwood Ave, Anytown'),
    (10, 'person14', 'person14@gradmarket.com', '701 Grand Ave, Anytown');


SELECT * FROM Buyer;

CREATE TABLE IF NOT EXISTS Seller(
	Seller_id INT NOT NULL UNIQUE, 
	Seller_Name VARCHAR(20) NOT NULL,
	Email VARCHAR(25),
	Address VARCHAR(50),
	PRIMARY KEY(Seller_id)
);

INSERT INTO 
	Seller(Seller_id, Seller_Name, Email, Address)
VALUES
	(1, 'person4', 'person4@gradmarket.com', '123 Main St, Anytown'),
    (2, 'person5', 'person5@gradmarket.com', '456 Oak St, Anytown'),
    (3, 'person9', 'person9@gradmarket.com', '789 Elm St, Anytown'), 
    (4, 'person10', 'person10@gradmarket.com', '321 Pine St, Anytown'), 
    (5, 'person15', 'person15@gradmarket.com', '654 Maple St, Anytown');
    
Select * from Seller;

CREATE TABLE IF NOT EXISTS Authenticate(
	Name VARCHAR(20) NOT NULL,
	Auth_id VARCHAR(25) NOT NULL UNIQUE, 
	Password VARCHAR(25) NOT NULL,
	PRIMARY KEY(Auth_id)
);

INSERT INTO 
	Authenticate(Name, Auth_id, Password)
VALUES
	('person1','person1@gradmarket.com', 'password1'),
	('person2','person2@gradmarket.com', 'password2'),
	('person3','person3@gradmarket.com', 'password3'),
	('person4','person4@gradmarket.com', 'password4'),
	('person5','person5@gradmarket.com', 'password5'),
	('person6','person6@gradmarket.com', 'password6'),
	('person7','person7@gradmarket.com', 'password7'),
	('person8','person8@gradmarket.com', 'password8'),
	('person9','person9@gradmarket.com', 'password9'),
	('person10','person10@gradmarket.com', 'password10'),
	('person11','person11@gradmarket.com', 'password11'),
	('person12','person12@gradmarket.com', 'password12'),
	('person13','person13@gradmarket.com', 'password13'),
	('person14','person14@gradmarket.com', 'password14'),
	('person15','person15@gradmarket.com', 'password15');
    
    
Select * from Authenticate;

CREATE TABLE IF NOT EXISTS Product(
	P_id int NOT NULL UNIQUE, 
	Title VARCHAR(50) NOT NULL,
    Description VARCHAR(100),
    Price float,
    Seller_id int not null,
	PRIMARY KEY(P_id),
    FOREIGN KEY (Seller_id) REFERENCES Seller(Seller_id)
);

INSERT INTO 
	Product(P_id, Title, Description, Price, Seller_id)
VALUES
	(1, 'iPhone 13 Pro', 'The latest iPhone model from Apple', 1299.99, 2),
    (2, 'Samsung Galaxy S21', 'A popular Android phone from Samsung', 899.99, 4),
    (3, 'MacBook Air', 'Apple\'s lightweight laptop', 999.99, 1),
    (4, 'Microsoft Surface Laptop 4', 'A powerful laptop from Microsoft', 1199.99, 5),
    (5, 'Sony WH-1000XM4', 'Noise-cancelling headphones from Sony', 349.99, 4),
    (6, 'Bose QuietComfort Earbuds', 'Wireless earbuds with noise-cancellation', 249.99, 1),
    (7, 'Canon EOS R6', 'A high-end mirrorless camera from Canon', 2399.99, 5),
    (8, 'Sony a7 III', 'A popular full-frame mirrorless camera from Sony', 1999.99, 3),
    (9, 'DJI Mavic Air 2', 'A compact drone with high-end features', 799.99, 2),
    (10, 'Apple Watch Series 7', 'The latest smartwatch from Apple', 399.99, 1),
    (11, 'Samsung 65-Inch QLED Q80A', 'A top-of-the-line 4K TV from Samsung', 2099.99, 5),
    (12, 'LG OLED65C1PUB', 'A high-end OLED TV from LG', 2499.99, 3),
    (13, 'PlayStation 5', 'The latest gaming console from Sony', 499.99, 4),
    (14, 'Xbox Series X', 'The latest gaming console from Microsoft', 499.99, 3),
    (15, 'Apple AirPods Pro', 'Wireless earbuds with noise-cancellation from Apple', 249.99, 1),
    (16, 'Samsung Galaxy Watch 4', 'The latest smartwatch from Samsung', 299.99, 4),
    (17, 'GoPro HERO10 Black', 'A high-end action camera from GoPro', 499.99, 2),
    (18, 'Nikon D850', 'A professional-level DSLR camera from Nikon', 3299.99, 3),
    (19, 'Sonos Roam', 'A portable smart speaker from Sonos', 169.99, 1),
    (20, 'Sony X950H 65-Inch TV', 'A high-end 4K TV from Sony', 1399.99, 2);
    
    
Select * from Product;

CREATE TABLE IF NOT EXISTS Payment(
	Payment_id int NOT NULL UNIQUE, 
	P_id int NOT NULL,
    B_id int NOT NULL,
    Amount float,
    Payment_time DATETIME not null,
	PRIMARY KEY(Payment_id),
    FOREIGN KEY (P_id) REFERENCES Product(P_id),
    FOREIGN KEY (B_id) REFERENCES Buyer(Buyer_id)
);

INSERT INTO 
	Payment(Payment_id , P_id , B_id , Amount , Payment_time)
VALUES
	(1, 5, 2, 339.00, '2022-03-15 14:35:21'),
    (2, 8, 3, 1900.00, '2022-03-18 09:12:07'),
    (3, 12, 1, 2400.00, '2022-03-22 16:20:59'),
    (4, 17, 5, 480.00, '2022-03-24 12:05:33'),
    (5, 3, 1, 950.00, '2022-03-26 18:44:12');
    
Select * from Payment;

CREATE TABLE IF NOT EXISTS Bid(
	Bid_id int NOT NULL UNIQUE, 
	P_id int NOT NULL,
    B_id int NOT NULL,
    Bid_price float,
	PRIMARY KEY(Bid_id),
    FOREIGN KEY (P_id) REFERENCES Product(P_id),
    FOREIGN KEY (B_id) REFERENCES Buyer(Buyer_id)
    
);

INSERT INTO 
	Bid(Bid_id, P_id, B_id, Bid_price)
VALUES
	(1, 1, 1, 1349.99),
    (2, 2, 1, 949.99),
    (3, 2, 2, 999.99),
    (4, 3, 2, 1019.99),
    (5, 3, 3, 1099.99),
    (6, 14, 3, 549.99),
    (7, 14, 4, 559.99),
    (8, 5, 4, 369.99),
    (9, 5, 5, 399.99),
    (10, 6, 5, 299.99),
    (11, 6, 6, 279.99),
    (12, 7, 6, 2499.99),
    (13, 7, 7, 2409.99),
    (14, 18, 7, 3399.99),
    (15, 18, 8, 3499.99),
    (16, 9, 8, 829.99),
    (17, 9, 9, 849.99),
    (18, 17, 8, 529.99),
    (19, 17, 9, 549.99),
    (20, 17, 10, 499.99);
    
    
Select * from Bid;


CREATE TABLE IF NOT EXISTS Listings(
	Listing_id int NOT NULL UNIQUE, 
	Status VARCHAR(15) NOT NULL,
    Start_date DATETIME NOT NULL,
    End_date DATETIME NOT NULL,
    Seller_id int NOT NULL,
	PRIMARY KEY(Listing_id),
    FOREIGN KEY (Seller_id) REFERENCES Seller(Seller_id)    
);

INSERT INTO 
	Listings(Listing_id , Status , Start_date , End_date , Seller_id)
VALUES
	(1, 'Active', '2023-04-01', '2023-04-10', 1),
    (2, 'Active', '2023-04-01', '2023-04-09', 2),
    (3, 'Active', '2023-04-01', '2023-04-08', 3),
    (4, 'Active', '2023-04-01', '2023-04-07', 4),
    (5, 'Active', '2023-04-01', '2023-04-06', 5),
    (6, 'Active', '2023-04-01', '2023-04-05', 1),
    (7, 'Active', '2023-04-01', '2023-04-04', 2),
    (8, 'Active', '2023-04-01', '2023-04-05', 3),
    (9, 'Active', '2023-04-01', '2023-04-05', 4),
    (10, 'Active', '2023-04-01', '2023-04-05', 5),
    (11, 'Inactive', '2023-03-30', '2023-04-02', 1),
    (12, 'Inactive', '2023-03-30', '2023-04-01', 2),
    (13, 'Inactive', '2023-03-30', '2023-03-31', 3),
    (14, 'Inactive', '2023-03-30', '2023-03-31', 4),
    (15, 'Inactive', '2023-03-30', '2023-04-03', 5),
    (16, 'Inactive', '2023-03-28', '2023-03-31', 1),
    (17, 'Inactive', '2023-03-28', '2023-04-02', 2),
    (18, 'Inactive', '2023-03-28', '2023-03-29', 3),
    (19, 'Inactive', '2023-03-28', '2023-03-28', 4),
    (20, 'Inactive', '2023-03-28', '2023-04-01', 5);

    
Select * from Listings;

CREATE TABLE IF NOT EXISTS Products_Bought(
	Transaction_id int NOT NULL UNIQUE,
	Buyer_id int NOT NULL, 
    P_id int NOT NULL,
	Title VARCHAR(50) NOT NULL,
    Price float,
    Seller_id int NOT NULL,
	PRIMARY KEY(Transaction_id),
    FOREIGN KEY (Buyer_id) REFERENCES buyer(Buyer_id) ,
    FOREIGN KEY (P_id) REFERENCES product(P_id), 
    FOREIGN KEY (Seller_id) REFERENCES Seller(Seller_id)
);

INSERT INTO 
	Products_Bought(Transaction_id, Buyer_id, P_id, Title, Price, Seller_id)
VALUES
	(1, 2, 1, 'iPhone Pro', 1299.99, 2),
    (2, 3, 3, 'MacBook Air', 999.99, 1);
    
Select * from Products_Bought;
