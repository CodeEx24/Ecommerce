CREATE TABLE users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Phone VARCHAR(15) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role TINYINT DEFAULT 0;
    Created_At DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Categories (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Image VARCHAR(255),
    Name VARCHAR(255) NOT NULL,
    Slug VARCHAR(255) NOT NULL,
    Description MEDIUMTEXT,
    Status TINYINT DEFAULT 1,
    Popular TINYINT DEFAULT 0,
    Meta_Title VARCHAR(255),
    Meta_Description MEDIUMTEXT,
    Meta_Keywords VARCHAR(255),
    Created_At DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Products (
  ID INTEGER PRIMARY KEY AUTO_INCREMENT,
  CategoryID INTEGER NOT NULL,
  FOREIGN KEY (CategoryID) REFERENCES Categories(ID) ON DELETE CASCADE,
  Name VARCHAR(255) NOT NULL,
  Slug VARCHAR(255) NOT NULL,
  Small_Description MEDIUMTEXT,
  Description MEDIUMTEXT NOT NULL,
  Original_Price DECIMAL(10,2) NOT NULL,
  Selling_Price DECIMAL(10,2) NOT NULL,
  Image VARCHAR(255) NOT NULL,
  Quantity INTEGER NOT NULL,
  Status TINYINT,
  Trending TINYINT,
  Meta_Title VARCHAR(255),
  Meta_Keywords MEDIUMTEXT,
  Meta_Description MEDIUMTEXT,
  Created_At DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Carts (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    Product_ID INT,
    Product_Qty INT,
    Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Orders (
  ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  Tracking_No VARCHAR(255) NOT NULL,
  User_ID INT NOT NULL,
  Name VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Phone VARCHAR(255) NOT NULL,
  Address VARCHAR(500) NOT NULL,
  Pincode INT NOT NULL,
  Total_Price FLOAT NOT NULL,
  Payment_Mode VARCHAR(255) NOT NULL,
  Payment_ID VARCHAR(255) NULL,
  Status TINYINT(1) DEFAULT 0 NOT NULL,
  Comments VARCHAR(500),
  Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE Order_Items (
  ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  Order_ID INT NOT NULL,
  Product_ID INT NOT NULL,
  Quantity INT NOT NULL,
  Price INT NOT NULL,
  Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY (Order_ID) REFERENCES orders(ID) ON DELETE CASCADE,
  FOREIGN KEY (Product_ID) REFERENCES products(ID)
);

-- INSERT VALUES
INSERT INTO Categories (Image, Name, Slug, Description, Status, Popular, Meta_Title, Meta_Description, Meta_Keywords) VALUES ('footwear.jpg', 'Footwear', 'footwear', 'A variety of footwear options for men, women, and children', 1, 1, 'Footwear for everyone', 'Shop our selection of footwear for men, women, and children', 'footwear, shoes, boots, sandals'), ('fashion.jpg', 'Fashion', 'fashion', 'Trendy clothing and accessories for men and women', 1, 1, 'Fashion for everyone', 'Stay on trend with our selection of fashion for men and women', 'fashion, clothing, accessories'), ('mobiles.jpg', 'Mobiles', 'mobiles', 'A wide selection of smartphones and mobile devices', 1, 1, 'Mobile phones and devices', 'Shop our selection of smartphones and mobile devices', 'mobiles, phones, devices'), ('groceries.jpg', 'Groceries', 'groceries', 'A wide variety of groceries and household items', 1, 1, 'Groceries and household items', 'Shop our selection of groceries and household items', 'groceries, household items'), ('laptops.jpg', 'Laptops & Computers', 'laptops', 'A wide selection of laptops, computers, and accessories', 1, 1, 'Laptops and computers', 'Shop our selection of laptops, computers, and accessories', 'laptops, computers, accessories'), ('accessories.jpg', 'Accessories', 'accessories', 'A wide selection of accessories for men, women, and children', 1, 1, 'Accessories for everyone', 'Shop our selection of accessories for men, women, and children', 'accessories, jewelry, bags'), ('entertainment.jpg', 'Home Entertainment', 'entertainment', 'A wide selection of home entertainment options', 1, 1, 'Home entertainment', 'Shop our selection of home entertainment options', 'entertainment, TVs, speakers');


INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description) VALUES 
(1, 'Leather Boots', 'leather-boots', 'A classic pair of leather boots', 'These boots are made of high-quality leather and feature a durable sole. They are perfect for both casual and formal occasions.', 99.99, 79.99, 'leather-boots.jpg', 50, 1, 1, 'Leather Boots - Classic and Durable', 'leather boots, classic, durable', 'Shop our selection of classic and durable leather boots'), (1, 'Sneakers', 'sneakers', 'Comfortable and stylish sneakers', 'These sneakers are made with a breathable mesh upper and a cushioned sole for maximum comfort. They come in a variety of colors to match any outfit.', 49.99, 39.99, 'sneakers.jpg', 100, 1, 1, 'Sneakers - Comfortable and Stylish', 'sneakers, comfortable, stylish', 'Shop our selection of comfortable and stylish sneakers'), (1, 'Sandals', 'sandals', 'Stylish and comfortable sandals', 'These sandals are made with a soft, flexible sole and a padded footbed for maximum comfort. They come in a variety of colors and styles to match any outfit.', 29.99, 19.99, 'sandals.jpg', 50, 1, 1, 'Sandals - Stylish and Comfortable', 'sandals, stylish, comfortable', 'Shop our selection of stylish and comfortable sandals'), 
(2, 'T-Shirt', 't-shirt', 'A classic t-shirt with a modern twist', 'This t-shirt is made of soft, comfortable cotton and features a trendy graphic print. It is perfect for casual wear or as a layering piece.', 24.99, 19.99, 't-shirt.jpg', 100, 1, 1, 'T-Shirt - Classic with a Modern Twist', 't-shirt, classic, modern', 'Shop our selection of classic t-shirts with a modern twist'), (2, 'Jeans', 'jeans', 'Stylish and comfortable jeans', 'These jeans are made of a soft and stretchy denim fabric and feature a modern fit. They come in a variety of colors and washes to match any outfit.', 59.99, 49.99, 'jeans.jpg', 50, 1, 1, 'Jeans - Stylish and Comfortable', 'jeans, stylish, comfortable', 'Shop our selection of stylish and comfortable jeans'), (2, 'Dress', 'dress', 'A stylish and versatile dress', 'This dress is made of a soft and stretchy fabric and features a flattering fit. It can be dressed up or down, making it perfect for any occasion.', 79.99, 69.99, 'dress.jpg', 25, 1, 1, 'Dress - Stylish and Versatile', 'dress, stylish, versatile', 'Shop our selection of stylish and versatile dresses'),  (3, 'Smartphone Case', 'smartphone-case', 'A protective case for your smartphone', 'This smartphone case is made of a durable material and is designed to protect your phone from drops, scratches, and other damage. It is perfect for those who want to keep their phone in pristine condition.', 19.99, 14.99, 'smartphone-case.jpg', 50, 1, 1, 'Smartphone Case - Protective', 'smartphone case, protective', 'Shop our selection of protective smartphone cases'), (3, 'Wireless Earbuds', 'wireless-earbuds', 'Wireless earbuds with excellent sound quality', 'These wireless earbuds are equipped with a variety of features and offer excellent sound quality. They are perfect for listening to music, taking calls, and more on the go.', 99.99, 79.99, 'wireless-earbuds.jpg', 50, 1, 1, 'Wireless Earbuds - Excellent Sound Quality', 'wireless earbuds, excellent sound quality', 'Shop our selection of wireless earbuds with excellent sound quality'), (3, 'Wireless Charger', 'wireless-charger', 'A wireless charger for your devices', 'This wireless charger is compatible with a variety of devices and allows you to charge your phone, earbuds, and other devices wirelessly. It is perfect for those who want a convenient and clutter-free charging solution.', 39.99, 29.99, 'wireless-charger.jpg', 50, 1, 1, 'Wireless Charger - Convenient and Clutter-Free', 'wireless charger, convenient, clutter-free', 'Shop our selection of convenient and clutter-free wireless chargers'), (4, 'Milk', 'milk', 'A gallon of fresh milk', 'This gallon of milk is sourced from local farms and is guaranteed to be fresh and delicious. It is perfect for drinking, cooking, or making smoothies.', 3.99, 3.49, 'milk.jpg', 50, 1, 1, 'Milk - Fresh and Delicious', 'milk, fresh, delicious', 'Shop our selection of fresh and delicious milk'), (4, 'Eggs', 'eggs', 'A dozen farm-fresh eggs', 'These eggs are sourced from local farms and are guaranteed to be fresh and delicious. They are perfect for cooking, baking, or making breakfast.', 3.49, 2.99, 'eggs.jpg', 50, 1, 1, 'Eggs - Fresh and Delicious', 'eggs, fresh, delicious', 'Shop our selection of fresh and delicious eggs'), (4, 'Bread', 'bread', 'A loaf of freshly-baked bread', 'This loaf of bread is baked fresh daily and is made with high-quality ingredients. It is perfect for sandwiches, toast, or making croutons.', 2.99, 2.49, 'bread.jpg', 50, 1, 1, 'Bread - Freshly-Baked', 'bread, freshly-baked', 'Shop our selection of freshly-baked bread'), (5, 'Laptop', 'laptop', 'A high-performance laptop', 'This laptop is equipped with a powerful processor, a high-resolution display, and a long-lasting battery. It is perfect for work, entertainment, or gaming.', 999.99, 899.99, 'laptop.jpg', 50, 1, 1, 'Laptop - High Performance', 'laptop, high performance', 'Shop our selection of high-performance laptops'), (5, 'Desktop Computer', 'desktop-computer', 'A powerful desktop computer', 'This desktop computer is equipped with a powerful processor, a high-resolution monitor, and a variety of connectivity options. It is perfect for work, entertainment, or gaming.', 799.99, 699.99, 'desktop-computer.jpg', 50, 1, 1, 'Desktop Computer - Powerful', 'desktop computer, powerful', 'Shop our selection of powerful desktop computers'), (5, 'Monitor', 'monitor', 'A high-resolution monitor', 'This monitor is equipped with a high-resolution display and a variety of connectivity options. It is perfect for work, entertainment, or gaming.', 499.99, 399.99, 'monitor.jpg', 50, 1, 1, 'Monitor - High Resolution', 'monitor, high resolution', 'Shop our selection of high-resolution monitors'), (6, 'Earrings', 'earrings', 'A pair of beautiful and stylish earrings', 'These earrings are made of high-quality materials and feature a unique design. They are perfect for dressing up any outfit.', 29.99, 19.99, 'earrings.jpg', 50, 1, 1, 'Earrings - Beautiful and Stylish', 'earrings, beautiful, stylish', 'Shop our selection of beautiful and stylish earrings'), (6, 'Bracelet', 'bracelet', 'A beautiful and stylish bracelet', 'This bracelet is made of high-quality materials and features a unique design. It is perfect for dressing up any outfit.', 39.99, 29.99, 'bracelet.jpg', 50, 1, 1, 'Bracelet - Beautiful and Stylish', 'bracelet, beautiful, stylish', 'Shop our selection of beautiful and stylish bracelets'), (6, 'Handbag', 'handbag', 'A stylish and practical handbag', 'This handbag is made of high-quality materials and features a stylish design. It is perfect for carrying all of your essentials in style.', 79.99, 69.99, 'handbag.jpg', 50, 1, 1, 'Handbag - Stylish and Practical', 'handbag, stylish, practical', 'Shop our selection of stylish and practical handbags'), (7, 'Television', 'television', 'A high-definition television', 'This television is equipped with a high-definition display and a variety of connectivity options. It is perfect for watching movies, TV shows, or sports.', 499.99, 399.99, 'television.jpg', 50, 1, 1, 'Television - High Definition', 'television, high definition', 'Shop our selection of high-definition televisions'), (7, 'Sound System', 'sound-system', 'A high-quality sound system', 'This sound system is equipped with powerful speakers and a variety of connectivity options. It is perfect for listening to music, watching movies, or hosting parties.', 399.99, 299.99, 'sound-system.jpg', 50, 1, 1, 'Sound System - High Quality', 'sound system, high quality', 'Shop our selection of high-quality sound systems'), (7, 'Streaming Device', 'streaming-device', 'A device for streaming movies, TV shows, and more', 'This streaming device is equipped with a variety of apps and features for streaming movies, TV shows, music, and more. It is perfect for entertainment on demand.', 99.99, 79.99, 'streaming-device.jpg', 50, 1, 1, 'Streaming Device - Entertainment On Demand', 'streaming device, entertainment, on demand', 'Shop our selection of streaming devices for entertainment on demand');


Dropping Table:
DROP TABLE Products;
DROP TABLE Categories;