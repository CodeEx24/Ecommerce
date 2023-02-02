CREATE TABLE users (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Phone VARCHAR(15) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role_As TINYINT DEFAULT 0,
    Created_At DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Categories (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Image VARCHAR(255) NOT NULL,
    Name VARCHAR(255) NOT NULL,
    Slug VARCHAR(255) NOT NULL,
    Description MEDIUMTEXT NOT NULL,
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
  Small_Description MEDIUMTEXT NOT NULL,
  Description MEDIUMTEXT NOT NULL,
  Original_Price DECIMAL(10,2) NOT NULL,
  Selling_Price DECIMAL(10,2) NOT NULL,
  Image VARCHAR(255) NOT NULL,
  Quantity INTEGER UNSIGNED NOT NULL,
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
    FOREIGN KEY (User_ID) REFERENCES Users(ID) ON DELETE CASCADE,
    Product_ID INT,
    FOREIGN KEY (Product_ID) REFERENCES Products(ID) ON DELETE CASCADE,
    Product_Qty INT,
    Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Wishlist (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    FOREIGN KEY (User_ID) REFERENCES users(ID) ON DELETE CASCADE,
    Product_ID INT,
    FOREIGN KEY (Product_ID) REFERENCES Products(ID) ON DELETE CASCADE,
    Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Orders (
  ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  Tracking_No VARCHAR(255) NOT NULL,
  User_ID INT NOT NULL,
  FOREIGN KEY (User_ID) REFERENCES users(ID) ON DELETE CASCADE,
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
  Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  Updated_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);

CREATE TABLE Order_Items (
  ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  Order_ID INT NOT NULL,
  Product_ID INT NOT NULL,
  Quantity INT NOT NULL,
  Price INT NOT NULL,
  Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY (Order_ID) REFERENCES orders(ID),
  FOREIGN KEY (Product_ID) REFERENCES products(ID)
);

CREATE TABLE Posts (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryID INT NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Image VARCHAR(255) NOT NULL,
    Slug VARCHAR(255) NOT NULL,
    Description MEDIUMTEXT COLLATE utf8_unicode_ci NOT NULL,
    Status TINYINT,
    Meta_Title VARCHAR(255),
    Meta_Keywords MEDIUMTEXT,
    Meta_Description MEDIUMTEXT,
    Created_At DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (CategoryID) REFERENCES Categories(ID)
);

CREATE TABLE Subscribers (
    ID INT PRIMARY KEY,
    Email VARCHAR(255) NOT NULL,
    Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Address (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Phone VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Province VARCHAR(255) NOT NULL,
    Street VARCHAR(255) NOT NULL,
    City VARCHAR(255) NOT NULL,
    Pincode VARCHAR(255) NOT NULL,
    Barangay VARCHAR(255),
    Bldg_houseno VARCHAR(255) NOT NULL,
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES users(ID) ON DELETE CASCADE
);


INSERT INTO users (Name, Phone, Email, Password, Role)
VALUES ('user', '+1 123 456 7890', 'user@gmail.com', 'user123', 0),
('admin', '+1 987 654 3210', 'admin@gmail.com', 'admin123', 1);


INSERT INTO Categories (Image, Name, Slug, Description, Status, Popular, Meta_Title, Meta_Description, Meta_Keywords) VALUES 
('books.jpg', 'Books', 'books', 'Books and literature products', 1, 1, 'Books Category Title', 'Meta description of Books Category', 'Books, Literature, Products'), 
("outdoor.jpg", "Outdoor", "outdoor", "Outdoor products", 1, 1, "Outdoor Products", "Discover our outdoor products", "outdoor, products"),
('mobiles.jpg', 'Mobiles', 'mobiles', 'A wide selection of smartphones and mobile devices', 1, 1, 'Mobile phones and devices', 'Shop our selection of smartphones and mobile devices', 'mobiles, phones, devices'), 
('groceries.jpg', 'Groceries', 'groceries', 'A wide variety of groceries and household items', 1, 1, 'Groceries and household items', 'Shop our selection of groceries and household items', 'groceries, household items'), 
('laptops.jpg', 'Laptops & Computers', 'laptops', 'A wide selection of laptops, computers, and accessories', 1, 1, 'Laptops and computers', 'Shop our selection of laptops, computers, and accessories', 'laptops, computers, accessories'), 
('accessories.jpg', 'Accessories', 'accessories', 'A wide selection of accessories for men, women, and children', 1, 1, 'Accessories for everyone', 'Shop our selection of accessories for men, women, and children', 'accessories, jewelry, bags'), 
('entertainment.jpg', 'Home Entertainment', 'entertainment', 'A wide selection of home entertainment options', 1, 1, 'Home entertainment', 'Shop our selection of home entertainment options', 'entertainment, TVs, speakers'),
("kids.jpg", "Kids", "kids", "Kids products", 1, 1, "Kids Products", "Discover our kids products", "kids, products");


INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description) VALUES 
(1, "To Kill a Mockingbird", "to-kill-a-mockingbird", "A classic novel about racial injustice", "To Kill a Mockingbird is a classic novel by Harper Lee, set in the 1930s in the fictional town of Maycomb, Alabama. The novel tells the story of Scout Finch and her brother Jem, who are raised by their father Atticus, a respected lawyer. The story centers around Atticus's defense of a black man, Tom Robinson, who is wrongly accused of raping a white woman. The novel explores themes of racial injustice, courage, and morality.", 10.00, 9.00, "to-kill-a-mockingbird.jpg", 100, 1, 1, "To Kill a Mockingbird - A classic novel by Harper Lee", "To Kill a Mockingbird, Harper Lee, Novel, Racial Injustice, Courage, Morality", "Buy To Kill a Mockingbird, a classic novel by Harper Lee about racial injustice, courage, and morality."), 
(1, "The Great Gatsby", "the-great-gatsby", "A novel about the decadence of the Roaring Twenties", "The Great Gatsby is a novel by F. Scott Fitzgerald, set in the Roaring Twenties. The novel follows the life of Jay Gatsby, a mysterious and wealthy man who throws extravagant parties in an attempt to win back his lost love, Daisy Buchanan. The story is a commentary on the decadence and excess of the era, as well as the shallowness of the people who lived during that time.", 11.00, 10.00, "the-great-gatsby.jpg", 100, 1, 1, "The Great Gatsby - A novel by F. Scott Fitzgerald", "The Great Gatsby, F. Scott Fitzgerald, Novel, Decadence, Roaring Twenties, Shallowness", "Buy The Great Gatsby, a novel by F. Scott Fitzgerald about the decadence and excess of the Roaring Twenties and the shallowness of the people who lived during that time."), 
(1, "Pride and Prejudice", "pride-and-prejudice", "A classic novel about love and social class", "Pride and Prejudice is a classic novel by Jane Austen, set in Georgian England. The novel tells the story of Elizabeth Bennet, a young woman who must navigate the treacherous waters of love and social class in order to find happiness. The story is a commentary on the societal norms of the time, as well as the dangers of pride and prejudice.", 12.00, 11.00, "pride-and-prejudice.jpg", 100, 1, 1, "Pride and Prejudice - A classic novel by Jane Austen", "Pride and Prejudice, Jane Austen, Novel, Love, Social Class, Georgian England", "Buy Pride and Prejudice, a classic novel by Jane Austen about love and social class in Georgian England."), 
(1, "Wuthering Heights", "wuthering-heights", "A novel about love and revenge set on the Yorkshire moors", "Wuthering Heights is a novel by Emily Bronte, set on the wild and desolate Yorkshire moors. The novel tells the story of Catherine Earnshaw and Heathcliff, two lovers whose passion for each other is matched only by their desire for revenge. The story is a complex exploration of love, revenge, and the consequences of both. The novel's setting on the bleak moors of Yorkshire adds to the sense of isolation and turmoil that permeates the story.", 13.00, 12.00, "wuthering-heights.jpg", 100, 1, 1, "Wuthering Heights - A novel by Emily Bronte", "Wuthering Heights, Emily Bronte, Novel, Love, Revenge, Yorkshire Moors", "Buy Wuthering Heights, a novel by Emily Bronte about love and revenge set on the wild and desolate Yorkshire moors."), 
(1, "The Lord of the Rings", "the-lord-of-the-rings", "A classic epic fantasy novel", "The Lord of the Rings is a classic epic fantasy novel by J.R.R. Tolkien. The novel follows hobbit Frodo Baggins as he embarks on a quest to destroy the One Ring, a powerful artifact created by the dark lord Sauron. Along the way, Frodo is joined by a fellowship of diverse characters, including humans, elves, and dwarves, who must work together to defeat Sauron and save Middle-earth.", 14.00, 13.00, "the-lord-of-the-rings.jpg", 100, 1, 1, "The Lord of the Rings - A classic epic fantasy novel by J.R.R. Tolkien", "The Lord of the Rings, J.R.R. Tolkien, Epic Fantasy, Middle-earth, One Ring, Sauron", "Buy The Lord of the Rings, a classic epic fantasy novel by J.R.R. Tolkien about hobbit Frodo Baggins and his quest to save Middle-earth."), 
(1, "The Hobbit", "the-hobbit", "A prequel to The Lord of the Rings", "The Hobbit is a novel by J.R.R. Tolkien and serves as a prequel to The Lord of the Rings. The novel follows hobbit Bilbo Baggins as he embarks on a dangerous journey to reclaim a lost treasure from the dragon Smaug. Along the way, Bilbo encounters a variety of creatures, including elves, dwarves, and goblins, and learns valuable lessons about courage and friendship.", 15.00, 14.00, "the-hobbit.jpg", 100, 1, 1, "The Hobbit - A prequel to The Lord of the Rings by J.R.R. Tolkien", "The Hobbit, J.R.R. Tolkien, Prequel, Lord of the Rings, Dragon Smaug, Courage, Friendship", "Buy The Hobbit, a prequel to The Lord of the Rings by J.R.R. Tolkien about hobbit Bilbo Baggins and his journey to reclaim a lost treasure from the dragon Smaug."),
(1, "The Chronicles of Narnia", "the-chronicles-of-narnia", "A series of fantasy novels for children", "The Chronicles of Narnia is a series of seven fantasy novels for children by C.S. Lewis. The series follows the adventures of a group of children who are transported to a magical land called Narnia, where they encounter talking animals, dwarves, and other magical creatures. The series is renowned for its imaginative world-building, memorable characters, and Christian themes.", 16.00, 15.00, "the-chronicles-of-narnia.jpg", 100, 1, 1, "The Chronicles of Narnia - A series of fantasy novels for children by C.S. Lewis", "The Chronicles of Narnia, C.S. Lewis, Fantasy, Children, Narnia, Talking Animals, Dwarves", "Buy The Chronicles of Narnia, a series of seven fantasy novels for children by C.S. Lewis, about the adventures of a group of children in the magical land of Narnia."),
(1, "The Catcher in the Rye", "the-catcher-in-the-rye", "A novel about adolescence and rebellion", "The Catcher in the Rye is a novel by J.D. Salinger, about a young man named Holden Caulfield who is struggling to come to terms with the world around him. The novel is a commentary on adolescence and the difficulties that young people face as they navigate the complexities of growing up. Holden's story is one of rebellion and nonconformity, as he rejects the hypocrisy and phoniness of the adult world.", 17.00, 16.00, "the-catcher-in-the-rye.jpg", 100, 1, 1, "The Catcher in the Rye - A novel about adolescence and rebellion by J.D. Salinger", "The Catcher in the Rye, J.D. Salinger, Adolescence, Rebellion, Holden Caulfield, Hypocrisy, Phoniness", "Buy The Catcher in the Rye, a novel about adolescence and rebellion by J.D. Salinger, about a young man named Holden Caulfield who is struggling to come to terms with the world around him."),
(1, "Moby Dick", "moby-dick", "A novel about a hunt for a giant white whale", "Moby Dick is a novel by Herman Melville, set in the 19th century. The novel follows Ishmael, a sailor who signs up for a dangerous voyage in pursuit of a giant white whale, Moby Dick. The story is a commentary on obsession, revenge, and the dangerous allure of the sea.", 15.00, 14.00, "moby-dick.jpg", 100, 1, 1, "Moby Dick - A novel by Herman Melville", "Moby Dick, Herman Melville, Novel, Whale, Hunt, Sea", "Buy Moby Dick, a novel by Herman Melville about a dangerous voyage in pursuit of a giant white whale."),
(1, "To the Lighthouse", "to-the-lighthouse", "A novel about the meaning of life", "To the Lighthouse is a novel by Virginia Woolf, set in the early 20th century. The novel follows the Ramsay family and their guests as they spend a summer at their home on the Isle of Skye. The story is a meditation on the meaning of life, the passage of time, and the nature of art and creativity.", 17.00, 16.00, "to-the-lighthouse.jpg", 100, 1, 1, "To the Lighthouse - A novel by Virginia Woolf", "To the Lighthouse, Virginia Woolf, Novel, Meaning of Life, Passage of Time, Art, Creativity", "Buy To the Lighthouse, a novel by Virginia Woolf about the meaning of life, the passage of time, and the nature of art and creativity.");

INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES 
  (2, "Backpack", "backpack", "Durable backpack for outdoor adventures", "Take all your essentials with you on your outdoor adventures with this durable backpack. It has multiple compartments and is made from high-quality materials.", 100.00, 90.00, "backpack.jpg", 60, 1, 1, "Backpack", "backpack, outdoor, adventure", "Durable backpack for outdoor adventures"),
  (2, "Camping Hammock", "camping-hammock", "Comfortable camping hammock for outdoor lounging", "Relax in comfort on your next camping trip with this camping hammock. It is made from soft and durable materials and can hold up to two people.", 70.00, 60.00, "camping-hammock.jpg", 70, 1, 1, "Camping Hammock", "camping, hammock, outdoor", "Comfortable camping hammock for outdoor lounging"),
  (2, "Camping Cooler", "camping-cooler", "Large and durable camping cooler", "Keep your food and drinks cold on your next camping trip with this large and durable camping cooler. It has multiple compartments and can hold up to 50 cans.", 200.00, 180.00, "camping-cooler.jpg", 80, 1, 1, "Camping Cooler", "camping, cooler, outdoor", "Large and durable camping cooler"),
  (2, "Camping Grill", "camping-grill", "Lightweight and portable camping grill", "Cook your meals on the go with this lightweight and portable camping grill. It runs on propane and has adjustable heat controls.", 90.00, 80.00, "camping-grill.jpg", 90, 1, 1, "Camping Grill", "camping, grill, outdoor", "Lightweight and portable camping grill"),
  (2, "Camping Pillow", "camping-pillow", "Comfortable camping pillow for a good night's sleep", "Get a good night's sleep on your next camping trip with this comfortable camping pillow. It is made from soft and supportive materials.", 20.00, 15.00, "camping-pillow.jpg", 100, 1, 1, "Camping Pillow", "camping, pillow, outdoor", "Comfortable camping pillow for a good night's sleep"),
  (2, "Camping Tent", "camping-tent", "Durable camping tent for outdoor enthusiasts", "This camping tent is perfect for outdoor enthusiasts who want a durable and long-lasting shelter. It is made from high-quality materials and can withstand harsh weather conditions.", 200.00, 180.00, "camping-tent.jpg", 10, 1, 1, "Camping Tent", "camping, tent, outdoor", "Durable camping tent for outdoor enthusiasts"),
  (2, "Sleeping Bag", "sleeping-bag", "Comfortable sleeping bag for camping trips", "Take comfort to the next level on your next camping trip with this sleeping bag. Made from soft and warm materials, you'll have a good night's sleep under the stars.", 150.00, 130.00, "sleeping-bag.jpg", 20, 1, 1, "Sleeping Bag", "sleeping, bag, camping", "Comfortable sleeping bag for camping trips"),
  (2, "Camping Stove", "camping-stove", "Lightweight and portable camping stove", "Cook your meals on your next camping trip with ease using this lightweight and portable camping stove. It runs on propane and has adjustable heat controls.", 80.00, 70.00, "camping-stove.jpg", 30, 1, 1, "Camping Stove", "camping, stove, outdoor", "Lightweight and portable camping stove"),
  (2, "Camping Chair", "camping-chair", "Comfortable camping chair for outdoor lounging", "Take a break and relax in style on your next camping trip with this comfortable camping chair. It has a sturdy frame and adjustable armrests for maximum comfort.", 50.00, 40.00, "camping-chair.jpg", 40, 1, 1, "Camping Chair", "camping, chair, outdoor", "Comfortable camping chair for outdoor lounging"),
  (2, "Camping Lantern", "camping-lantern", "Bright and portable camping lantern", "Light up your campsite with this bright and portable camping lantern. It runs on batteries and has adjustable brightness levels.", 30.00, 25.00, "camping-lantern.jpg", 50, 1, 1, "Camping Lantern", "camping, lantern, outdoor", "Bright and portable camping lantern");

INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES 
(3, 'iPhone X', 'iphone-x', 'Newest iPhone X model', 'The latest iPhone X model features a sleek design and powerful hardware', 999.99, 799.99, 'iphone-x.jpg', 100, 1, 0, 'iPhone X - The latest and greatest', 'apple, iphone, x, latest', 'The latest iPhone X model is now available in our store'),
(3, 'Samsung Galaxy S21', 'samsung-galaxy-s21', 'Samsung Galaxy S21', 'The new Samsung Galaxy S21 is a powerful smartphone with an immersive display', 899.99, 799.99, 'samsung-galaxy-s21.jpg', 200, 1, 1, 'Samsung Galaxy S21 - The latest from Samsung', 'samsung, galaxy, s21, latest', 'The latest Samsung Galaxy S21 is now available in our store'),
(3, 'Google Pixel 5', 'google-pixel-5', 'Google Pixel 5', 'The new Google Pixel 5 is a fast and efficient smartphone with a great camera', 799.99, 699.99, 'google-pixel-5.jpg', 150, 1, 0, 'Google Pixel 5 - A great smartphone from Google', 'google, pixel, 5, latest', 'The latest Google Pixel 5 is now available in our store'),
(3, 'OnePlus 8T', 'oneplus-8t', 'OnePlus 8T', 'The new OnePlus 8T is a powerful smartphone with fast charging and a large battery', 699.99, 599.99, 'oneplus-8t.jpg', 250, 1, 0, 'OnePlus 8T - A great smartphone from OnePlus', 'oneplus, 8t, latest', 'The latest OnePlus 8T is now available in our store'),
(3, 'Huawei P40 Pro', 'huawei-p40-pro', 'Huawei P40 Pro', 'The new Huawei P40 Pro is a high-end smartphone with advanced camera capabilities', 999.99, 799.99, 'huawei-p40-pro.jpg', 200, 1, 0, 'Huawei P40 Pro - A great smartphone from Huawei', 'huawei, p40, pro, latest', 'The latest Huawei P40 Pro is now available in our store'),
(3, 'iPhone 12', 'iphone-12', 'The latest iPhone model', 'The iPhone 12 is the latest model in the iPhone lineup. It features a 6.1-inch Super Retina XDR display, 5G capabilities, and more.', 999.99, 899.99, 'iphone-12.jpg', 100, 1, 1, 'iPhone 12', 'iPhone, Apple, smartphone', 'Get the latest iPhone model, the iPhone 12, with 5G capabilities and a 6.1-inch Super Retina XDR display'),
(3, 'Samsung Galaxy S21', 'samsung-galaxy-s21', 'The latest Samsung smartphone', 'The Samsung Galaxy S21 is the latest addition to the Samsung Galaxy lineup. It features a 6.2-inch Dynamic AMOLED 2X display, 5G capabilities, and more.', 899.99, 849.99, 'samsung-galaxy-s21.jpg', 100, 1, 0, 'Samsung Galaxy S21', 'Samsung, Galaxy, smartphone', 'Get the latest Samsung smartphone, the Samsung Galaxy S21, with 5G capabilities and a 6.2-inch Dynamic AMOLED 2X display'),
(3, 'OnePlus 9 Pro', 'oneplus-9-pro', 'The latest OnePlus smartphone', 'The OnePlus 9 Pro is the latest addition to the OnePlus lineup. It features a 6.7-inch Fluid AMOLED display, 5G capabilities, and more.', 799.99, 749.99, 'oneplus-9-pro.jpg', 100, 1, 0, 'OnePlus 9 Pro', 'OnePlus, smartphone', 'Get the latest OnePlus smartphone, the OnePlus 9 Pro, with 5G capabilities and a 6.7-inch Fluid AMOLED display'),
(3, 'Google Pixel 6', 'google-pixel-6', 'The latest Google smartphone', 'The Google Pixel 6 is the latest addition to the Google Pixel lineup. It features a 6.4-inch AMOLED display, 5G capabilities, and more.', 699.99, 649.99, 'google-pixel-6.jpg', 100, 1, 0, 'Google Pixel 6', 'Google, Pixel, smartphone', 'Get the latest Google smartphone, the Google Pixel 6, with 5G capabilities and a 6.4-inch AMOLED display'),
(3, 'LG Velvet', 'lg-velvet', 'The latest LG smartphone', 'The LG Velvet is the latest addition to the LG lineup. It features a 6.8-inch P-OLED display, 5G capabilities, and more.', 599.99, 549.99, 'lg-velvet.jpg', 100, 1, 0, 'LG Velvet', 'LG, smartphone', 'Get the latest LG smartphone, the LG Velvet, with 5G capabilities and a 6.8-inch P-OLED display');

INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES
(4, 'Milk', 'milk', 'A gallon of milk', 'A gallon of milk, perfect for cereal or baking', 2.99, 2.79, 'milk.jpg', 100, 1, 0, 'Milk', 'Milk, Groceries, Household', 'Get a gallon of milk for your cereal or baking needs'),
(4, 'Bread', 'bread', 'A loaf of bread', 'A loaf of bread, perfect for sandwiches or toast', 1.99, 1.79, 'bread.jpg', 100, 1, 0, 'Bread', 'Bread, Groceries, Household', 'Get a loaf of bread for your sandwiches or toast needs'),
(4, 'Eggs', 'eggs', 'A dozen eggs', 'A dozen eggs, perfect for breakfast or baking', 2.49, 2.29, 'eggs.jpg', 100, 1, 0, 'Eggs', 'Eggs, Groceries, Household', 'Get a dozen eggs for your breakfast or baking needs'),
(4, 'Sugar', 'sugar', 'A bag of sugar', 'A bag of sugar, perfect for baking or sweetening your drinks', 1.99, 1.79, 'sugar.jpg', 100, 1, 0, 'Sugar', 'Sugar, Groceries, Household', 'Get a bag of sugar for your baking or sweetening needs'),
(4, 'Butter', 'butter', 'A stick of butter', 'A stick of butter, perfect for baking or cooking', 2.99, 2.79, 'butter.jpg', 100, 1, 0, 'Butter', 'Butter, Groceries, Household', 'Get a stick of butter for your baking or cooking needs'),
(4, 'Rice', 'rice', 'A staple in many households', 'Rice is a staple food in many households around the world. It can be used in a variety of dishes and is a great source of carbohydrates.', 4.99, 3.99, 'rice.jpg', 1000, 1, 0, 'Rice for Sale', 'rice, staple food, carbohydrates', 'Shop our selection of rice, a staple food and great source of carbohydrates'),
(4, 'Pasta', 'pasta', 'A classic staple food', 'Pasta is a classic staple food that is loved by many. It is a versatile ingredient that can be used in a variety of dishes and is a great source of carbohydrates.', 3.99, 2.99, 'pasta.jpg', 1000, 1, 0, 'Pasta for Sale', 'pasta, staple food, carbohydrates', 'Shop our selection of pasta, a classic staple food and great source of carbohydrates'),
(4, 'Bread', 'bread', 'A staple in many households', 'Bread is a staple food in many households around the world. It can be used for sandwiches, toast, and more.', 2.99, 1.99, 'bread.jpg', 1000, 1, 0, 'Bread for Sale', 'bread, staple food', 'Shop our selection of bread, a staple food in many households'),
(4, 'Eggs', 'eggs', 'A versatile ingredient', 'Eggs are a versatile ingredient that can be used in a variety of dishes. They are a great source of protein and other nutrients.', 3.99, 2.99, 'eggs.jpg', 1000, 1, 0, 'Eggs for Sale', 'eggs, versatile ingredient, protein', 'Shop our selection of eggs, a versatile ingredient and great source of protein'),
(4, 'Milk', 'milk', 'A staple in many households', 'Milk is a staple in many households around the world. It can be used for drinking, cooking, and more.', 2.99, 1.99, 'milk.jpg', 1000, 1, 0, 'Milk for Sale', 'milk, staple food', 'Shop our selection of milk, a staple in many households');


INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES
(5, 'MacBook Pro', 'macbook-pro', '16-inch MacBook Pro', 'The 16-inch MacBook Pro is a powerful laptop with the latest technology.', 1999.99, 1799.99, 'macbook-pro.jpg', 100, 1, 1, 'MacBook Pro', 'MacBook Pro, laptop, computer, Apple', 'Buy the latest MacBook Pro with 16-inch screen and the latest technology.'),
(5, 'HP Envy x360', 'hp-envy-x360', '2-in-1 Laptop', 'The HP Envy x360 is a versatile 2-in-1 laptop that can be used as a laptop or tablet.', 899.99, 799.99, 'hp-envy-x360.jpg', 150, 1, 0, 'HP Envy x360', 'HP Envy x360, 2-in-1 laptop, computer, HP', 'Get the best of both worlds with the HP Envy x360 2-in-1 laptop.'),
(5, 'Dell XPS 13', 'dell-xps-13', 'Thin and Light Laptop', 'The Dell XPS 13 is a thin and light laptop that is perfect for travel or everyday use.', 999.99, 899.99, 'dell-xps-13.jpg', 200, 1, 1, 'Dell XPS 13', 'Dell XPS 13, thin laptop, computer, Dell', 'Buy the latest Dell XPS 13 thin and light laptop for your travel or everyday use.'),
(5, 'Microsoft Surface Pro', 'microsoft-surface-pro', '2-in-1 Laptop', 'The Microsoft Surface Pro is a versatile 2-in-1 laptop that can be used as a laptop or tablet.', 999.99, 899.99, 'microsoft-surface-pro.jpg', 200, 1, 0, 'Microsoft Surface Pro', 'Microsoft Surface Pro, 2-in-1 laptop, computer, Microsoft', 'Get the best of both worlds with the Microsoft Surface Pro 2-in-1 laptop.'),
(5, 'Acer Aspire 5', 'acer-aspire-5', 'Affordable Laptop', 'The Acer Aspire 5 is an affordable laptop that offers good performance for everyday use.', 499.99, 449.99, 'acer-aspire-5.jpg', 300, 1, 0, 'Acer Aspire 5', 'Acer Aspire 5, affordable laptop, computer, Acer', 'Buy the latest Acer Aspire 5 affordable laptop for your everyday use.'),
(5, 'Lenovo ThinkPad X1 Carbon', 'lenovo-thinkpad-x1-carbon', 'Business Laptop', 'The Lenovo ThinkPad X1 Carbon is a business laptop that offers strong performance and durability.', 1499.99, 1399.99, 'lenovo-thinkpad-x1-carbon.jpg', 100, 1, 0, 'Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon, business laptop, computer, Lenovo', 'Get a business laptop that offers strong performance and durability with the Lenovo ThinkPad X1 Carbon.'),
(5, 'Asus ROG Zephyrus', 'asus-rog-zephyrus', 'Gaming Laptop', 'The Asus ROG Zephyrus is a high-performance gaming laptop with a sleek design.', 1999.99, 1799.99, 'asus-rog-zephyrus.jpg', 50, 1, 1, 'Asus ROG Zephyrus', 'Asus ROG Zephyrus, gaming laptop, computer, Asus', 'Play your favorite games with the high-performance Asus ROG Zephyrus gaming laptop.'),
(5, 'Google Pixelbook Go', 'google-pixelbook-go', 'Chrome OS Laptop', 'The Google Pixelbook Go is a laptop running the Chrome OS that is fast and lightweight.', 899.99, 799.99, 'google-pixelbook-go.jpg', 200, 1, 0, 'Google Pixelbook Go', 'Google Pixelbook Go, Chrome OS laptop, computer, Google', 'Get a fast and lightweight laptop with the Google Pixelbook Go running the Chrome OS.'),
(5, 'Razer Blade', 'razer-blade', 'Gaming Laptop', 'The Razer Blade is a high-performance gaming laptop with a sleek design.', 1999.99, 1799.99, 'razer-blade.jpg', 50, 1, 0, 'Razer Blade', 'Razer Blade, gaming laptop, computer, Razer', 'Play your favorite games with the high-performance Razer Blade gaming laptop.'),
(5, 'Apple MacBook Air', 'apple-macbook-air', 'Thin and Light Laptop', 'The Apple MacBook Air is a thin and light laptop that is perfect for travel or everyday use.', 999.99, 899.99, 'apple-macbook-air.jpg', 200, 1, 1, 'Apple MacBook Air', 'Apple MacBook Air, thin laptop, computer, Apple', 'Buy the latest Apple MacBook Air thin and light laptop for your travel or everyday use.');

INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES
(6, 'Leather Backpack', 'leather-backpack', 'Stylish and Durable Backpack', 'The Leather Backpack is a stylish and durable backpack that is perfect for everyday use.', 199.99, 179.99, 'leather-backpack.jpg', 50, 1, 1, 'Leather Backpack', 'Leather Backpack, stylish backpack, durable backpack', 'Buy the latest Leather Backpack for your everyday use.'),
(6, 'Leather Wallet', 'leather-wallet', 'Stylish and Durable Wallet', 'The Leather Wallet is a stylish and durable wallet that is perfect for everyday use.', 49.99, 39.99, 'leather-wallet.jpg', 100, 1, 0, 'Leather Wallet', 'Leather Wallet, stylish wallet, durable wallet', 'Buy the latest Leather Wallet for your everyday use.'),
(6, 'Leather Phone Case', 'leather-phone-case', 'Stylish and Durable Phone Case', 'The Leather Phone Case is a stylish and durable phone case that is perfect for protecting your phone.', 29.99, 19.99, 'leather-phone-case.jpg', 150, 1, 0, 'Leather Phone Case', 'Leather Phone Case, stylish phone case, durable phone case', 'Buy the latest Leather Phone Case for protecting your phone.'),
(6, 'Leather Luggage', 'leather-luggage', 'Stylish and Durable Luggage', 'The Leather Luggage is a stylish and durable luggage that is perfect for travel.', 299.99, 279.99, 'leather-luggage.jpg', 100, 1, 1, 'Leather Luggage', 'Leather Luggage, stylish luggage, durable luggage', 'Buy the latest Leather Luggage for your travel.'),
(6, 'Leather Keychain', 'leather-keychain', 'Stylish and Durable Keychain', 'The Leather Keychain is a stylish and durable keychain that is perfect for everyday use.', 19.99, 9.99, 'leather-keychain.jpg', 200, 1, 0, 'Leather Keychain', 'Leather Keychain, stylish keychain, durable keychain', 'Buy the latest Leather Keychain for your everyday use.'),
(6, 'Mens Leather Wallet', 'leather-wallet-for-men', 'Mens leather wallet', 'A stylish mens leather wallet that is perfect for everyday use.', 49.99, 39.99, 'leather-wallet-for-men.jpg', 100, 1, 1, 'Mens Leather Wallet', 'Mens leather wallet, leather, wallet, men', 'Buy a stylish mens leather wallet for everyday use.'),
(6, 'Womens Leather Handbag', 'leather-handbag-for-women', 'Womens leather handbag', 'A stylish womens leather handbag that is perfect for everyday use.', 99.99, 89.99, 'leather-handbag-for-women.jpg', 50, 1, 0, 'Womens Leather Handbag', 'Womens leather handbag, leather, handbag, women', 'Buy a stylish womens leather handbag for everyday use.'),
(6, 'Mens Leather Belt', 'leather-belt-for-men', 'Mens leather belt', 'A stylish mens leather belt that is perfect for everyday wear.', 29.99, 24.99, 'leather-belt-for-men.jpg', 200, 1, 1, 'Mens Leather Belt', 'Mens leather belt, leather, belt, men', 'Buy a stylish mens leather belt for everyday wear.'),
(6, 'Womens Sunglasses', 'women-sunglasses', 'Womens sunglasses', 'A stylish pair of womens sunglasses that are perfect for sunny days.', 39.99, 29.99, 'women-sunglasses.jpg', 100, 1, 0, 'Womens Sunglasses', 'Womens sunglasses, sunglasses, women', 'Buy a stylish pair of womens sunglasses for sunny days.'),
(6, 'Childrens Backpack', 'children-backpack', 'Childrens backpack', 'A stylish childrens backpack that is perfect for school or travel.', 29.99, 24.99, 'children-backpack.jpg', 150, 1, 0, 'Childrens Backpack', 'Childrens backpack, backpack, children', 'Buy a stylish childrens backpack for school or travel.');


INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES 
(7, "Playstation 5", "playstation-5", "Next-Gen Console", "The Playstation 5 is the latest next-generation gaming console from Sony. With a sleek design and powerful hardware, it is perfect for gamers who demand the best.", 499.99, 449.99, "ps5.jpg", 50, 1, 1, "Playstation 5 - Next-Gen Console", "Playstation, Gaming, Console", "Buy the latest Playstation 5 gaming console"),
(7, "4K Smart TV", "4k-smart-tv", "Ultra HD TV", "Upgrade your viewing experience with this 4K Smart TV. With a large screen and vibrant colors, you will never want to leave your couch.", 799.99, 699.99, "4ktv.jpg", 30, 1, 1, "4K Smart TV - Ultra HD Experience", "TV, 4K, Smart, Home entertainment", "Experience the best in home entertainment with this 4K Smart TV"),
(7, "Blu-Ray Player", "blu-ray-player", "High-Definition Movie Player", "Get the most out of your movie collection with this Blu-Ray player. With high-definition playback and upscaling, you will enjoy every film in stunning detail.", 99.99, 79.99, "bluray.jpg", 50, 1, 0, "Blu-Ray Player - High-Definition Movie Experience", "Blu-Ray, Movie, Player, Home entertainment", "Enjoy your movie collection in stunning detail with this Blu-Ray player"),
(7, "Nintendo Switch", "nintendo-switch", "Hybrid Gaming Console", "The Nintendo Switch is a hybrid gaming console that allows you to play your favorite games both at home and on-the-go. With a large game library, there is something for everyone.", 299.99, 279.99, "switch.jpg", 50, 1, 1, "Nintendo Switch - Hybrid Gaming Console", "Nintendo, Switch, Gaming, Console", "Play your favorite games both at home and on-the-go with the Nintendo Switch"),
(7, "Home Theater System", "home-theater-system", "Surround Sound System", "Transform your living room into a home theater with this surround sound system. With powerful speakers and immersive audio, you will feel like you're at the movies.", 499.99, 399.99, "hometheater.jpg", 20, 1, 0, "Home Theater System - Surround Sound Experience", "Home theater, Sound, System, Entertainment", "Bring the movie theater experience to your living room with this home theater system"),
(7, "VR Headset", "vr-headset", "Virtual Reality Headset", "Step into a new world with this VR headset. With a large field of view and accurate motion tracking, you will be fully immersed in the virtual reality experience.", 299.99, 249.99, "vrheadset.jpg", 30, 1, 0, "VR Headset - Virtual Reality Experience", "VR, Headset, Virtual reality, Gaming", "Experience a new world with this VR headset"),
(7, "Soundbar", "soundbar", "Upgrade Your TV Sound", "Take your TV audio to the next level with this soundbar. With powerful speakers and easy setup, you will enjoy high-quality sound with every program.", 199.99, 149.99, "soundbar.jpg", 40, 1, 0, "Soundbar - Upgrade Your TV Sound", "Soundbar, TV, Audio, Home entertainment", "Improve your TV audio with this soundbar"),
(7, "Streaming Stick", "streaming-stick", "Stream Your Favorite Content", "Stream your favorite content with this streaming stick. With a compact design and access to hundreds of channels, you will never run out of things to watch.", 49.99, 39.99, "streamingstick.jpg", 50, 1, 0, "Streaming Stick - Stream Your Favorite Content", "Streaming, Stick, TV, Content", "Enjoy your favorite content on any TV with this streaming stick"),
(7, "Bluetooth Speaker", "bluetooth-speaker", "Portable Sound System", "Take your music with you with this Bluetooth speaker. With long battery life and high-quality sound, you can enjoy your tunes anywhere, anytime.", 99.99, 89.99, "bluetoothspeaker.jpg", 50, 1, 0, "Bluetooth Speaker - Portable Sound System", "Bluetooth, Speaker, Portable, Sound", "Enjoy high-quality sound anywhere with this portable Bluetooth speaker"),
(7, "Gaming Chair", "gaming-chair", "Comfortable Gaming Seat", "Get comfortable and stay focused with this gaming chair. With adjustable settings and a sleek design, you will game in style.", 249.99, 199.99, "gamingchair.jpg", 30, 1, 0, "Gaming Chair - Comfortable Gaming Seat", "Gaming, Chair, Comfort, Seat", "Stay comfortable and focused with this stylish gaming chair");



INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description)
VALUES
(8, "Toy Car", "toy-car", "Remote control toy car for kids", "Remote control toy car for kids with lights and sound effects", 20.00, 15.00, "toy-car.jpg", 20, 1, 0, "Toy Car", "toy car, kids, remote control", "Remote control toy car for kids with lights and sound effects"),
(8, "Action Figure", "action-figure", "Marvel action figure for kids", "Marvel action figure for kids with accessories", 15.00, 10.00, "action-figure.jpg", 15, 1, 1, "Action Figure", "action figure, kids, marvel", "Marvel action figure for kids with accessories"),
(8, "Lego Set", "lego-set", "Lego set for kids", "Lego set for kids with instructions and accessories", 25.00, 20.00, "lego-set.jpg", 10, 1, 0, "Lego Set", "lego set, kids", "Lego set for kids with instructions and accessories"),
(8, "Board Game", "board-game", "Family board game for kids", "Family board game for kids with multiple players", 15.00, 10.00, "board-game.jpg", 15, 1, 1, "Board Game", "board game, kids, family", "Family board game for kids with multiple players"),
(8, "Puzzle", "puzzle", "3D puzzle for kids", "3D puzzle for kids with different difficulty levels", 10.00, 5.00, "puzzle.jpg", 20, 1, 0, "Puzzle", "puzzle, kids, 3D", "3D puzzle for kids with different difficulty levels"),
(8, "Coloring Book", "coloring-book", "A fun coloring book for kids", "This coloring book contains various illustrations for kids to color and have fun.", 7.99, 4.99, "coloring-book.jpg", 150, 1, 1, "Coloring Book for Kids", "coloring book, kids, fun", "Get this fun coloring book for your kids to enjoy"),
(8, "Kids Backpack", "kids-backpack", "A durable backpack for kids", "This backpack is designed for kids, made of durable material, and it has various compartments to store their belongings.", 22.99, 18.99, "kids-backpack.jpg", 50, 1, 0, "Durable Backpack for Kids", "kids, backpack, durable", "Get this durable backpack for your kids to store their belongings"),
(8, "Kids Shoes", "kids-shoes", "Comfortable shoes for kids", "These shoes are made of soft and comfortable material, perfect for kids daily wear.", 29.99, 24.99, "kids-shoes.jpg", 40, 1, 0, "Comfortable Shoes for Kids", "kids, shoes, comfortable", "Get these comfortable shoes for your kids to wear daily"),
(8, "Kids Scooter", "kids-scooter", "A safe and fun scooter for kids", "This scooter is perfect for kids of all ages. It's made from durable materials and features a safe design. Great for outdoor play.", 49.99, 39.99, "scooter.jpg", 75, 1, 1, "Kids Scooter - Safe and Fun", "scooter, kids, safe, fun", "Get your kids the safe and fun scooter they will love to ride and play with!"),
(8, "Kids Play Tent", "kids-play-tent", "A fun and cozy play tent for kids", "This play tent is perfect for kids of all ages. It's made from durable materials and features a cozy design. Great for indoor and outdoor play.", 39.99, 34.99, "play-tent.jpg", 50, 1, 1, "Kids Play Tent - Fun and Cozy", "play tent, kids, fun, cozy", "Get your kids the fun and cozy play tent they will love to play and imagine with!");































INSERT INTO Categories (Image, Name, Slug, Description, Status, Popular, Meta_Title, Meta_Description, Meta_Keywords) 
VALUES
("entertainment.jpg", "Entertainment", "entertainment", "Entertainment products", 1, 0, "Entertainment Products", "Discover our entertainment products", "entertainment, products"),
("accessories.jpg", "Accessories", "accessories", "Accessories for everyday use", 1, 1, "Accessories", "Get the best accessories for your daily life", "accessories, everyday use"),
("electronics.jpg", "Electronics", "electronics", "Electronics for everyday use", 1, 1, "Electronics", "Get the best electronics for your daily life", "electronics, everyday use"),
("sports.jpg", "Sports", "sports", "Sports products", 1, 0, "Sports Products", "Discover our sports products", "sports, products"),
("health.jpg", "Health", "health", "Health and wellness products", 1, 0, "Health and Wellness Products", "Discover our health and wellness products", "health, wellness, products"),
("beauty.jpg", "Beauty", "beauty", "Beauty and personal care products", 1, 0, "Beauty and Personal Care Products", "Discover our beauty and personal care products", "beauty, personal care, products"),
("outdoor.jpg", "Outdoor", "outdoor", "Outdoor products", 1, 0, "Outdoor Products", "Discover our outdoor products", "outdoor, products"),
("fashion.jpg", "Fashion", "fashion", "Fashion products", 1, 0, "Fashion Products", "Discover our fashion products", "fashion, products"),
("home.jpg", "Home", "home", "Home products", 1, 0, "Home Products", "Discover our home products", "home, products"),
("kids.jpg", "Kids", "kids", "Kids products", 1, 0, "Kids Products", "Discover our kids products", "kids, products"),
('books.jpg', 'Books', 'books', 'Books and literature products', 1, 1, 'Books Category Title', 'Meta description of Books Category', 'Books, Literature, Products');







INSERT INTO Products (CategoryID, Name, Slug, Small_Description, Description, Original_Price, Selling_Price, Image, Quantity, Status, Trending, Meta_Title, Meta_Keywords, Meta_Description) VALUES 
(1, 'Leather Boots', 'leather-boots', 'A classic pair of leather boots', 'These boots are made of high-quality leather and feature a durable sole. They are perfect for both casual and formal occasions.', 99.99, 79.99, 'leather-boots.jpg', 50, 1, 1, 'Leather Boots - Classic and Durable', 'leather boots, classic, durable', 'Shop our selection of classic and durable leather boots'), (1, 'Sneakers', 'sneakers', 'Comfortable and stylish sneakers', 'These sneakers are made with a breathable mesh upper and a cushioned sole for maximum comfort. They come in a variety of colors to match any outfit.', 49.99, 39.99, 'sneakers.jpg', 100, 1, 1, 'Sneakers - Comfortable and Stylish', 'sneakers, comfortable, stylish', 'Shop our selection of comfortable and stylish sneakers'), (1, 'Sandals', 'sandals', 'Stylish and comfortable sandals', 'These sandals are made with a soft, flexible sole and a padded footbed for maximum comfort. They come in a variety of colors and styles to match any outfit.', 29.99, 19.99, 'sandals.jpg', 50, 1, 1, 'Sandals - Stylish and Comfortable', 'sandals, stylish, comfortable', 'Shop our selection of stylish and comfortable sandals'), 

(2, 'T-Shirt', 't-shirt', 'A classic t-shirt with a modern twist', 'This t-shirt is made of soft, comfortable cotton and features a trendy graphic print. It is perfect for casual wear or as a layering piece.', 24.99, 19.99, 't-shirt.jpg', 100, 1, 1, 'T-Shirt - Classic with a Modern Twist', 't-shirt, classic, modern', 'Shop our selection of classic t-shirts with a modern twist'), (2, 'Jeans', 'jeans', 'Stylish and comfortable jeans', 'These jeans are made of a soft and stretchy denim fabric and feature a modern fit. They come in a variety of colors and washes to match any outfit.', 59.99, 49.99, 'jeans.jpg', 50, 1, 1, 'Jeans - Stylish and Comfortable', 'jeans, stylish, comfortable', 'Shop our selection of stylish and comfortable jeans'), (2, 'Dress', 'dress', 'A stylish and versatile dress', 'This dress is made of a soft and stretchy fabric and features a flattering fit. It can be dressed up or down, making it perfect for any occasion.', 79.99, 69.99, 'dress.jpg', 25, 1, 1, 'Dress - Stylish and Versatile', 'dress, stylish, versatile', 'Shop our selection of stylish and versatile dresses'),  

(3, 'Smartphone Case', 'smartphone-case', 'A protective case for your smartphone', 'This smartphone case is made of a durable material and is designed to protect your phone from drops, scratches, and other damage. It is perfect for those who want to keep their phone in pristine condition.', 19.99, 14.99, 'smartphone-case.jpg', 50, 1, 1, 'Smartphone Case - Protective', 'smartphone case, protective', 'Shop our selection of protective smartphone cases'), (3, 'Wireless Earbuds', 'wireless-earbuds', 'Wireless earbuds with excellent sound quality', 'These wireless earbuds are equipped with a variety of features and offer excellent sound quality. They are perfect for listening to music, taking calls, and more on the go.', 99.99, 79.99, 'wireless-earbuds.jpg', 50, 1, 1, 'Wireless Earbuds - Excellent Sound Quality', 'wireless earbuds, excellent sound quality', 'Shop our selection of wireless earbuds with excellent sound quality'), (3, 'Wireless Charger', 'wireless-charger', 'A wireless charger for your devices', 'This wireless charger is compatible with a variety of devices and allows you to charge your phone, earbuds, and other devices wirelessly. It is perfect for those who want a convenient and clutter-free charging solution.', 39.99, 29.99, 'wireless-charger.jpg', 50, 1, 1, 'Wireless Charger - Convenient and Clutter-Free', 'wireless charger, convenient, clutter-free', 'Shop our selection of convenient and clutter-free wireless chargers'), 

(4, 'Milk', 'milk', 'A gallon of fresh milk', 'This gallon of milk is sourced from local farms and is guaranteed to be fresh and delicious. It is perfect for drinking, cooking, or making smoothies.', 3.99, 3.49, 'milk.jpg', 50, 1, 1, 'Milk - Fresh and Delicious', 'milk, fresh, delicious', 'Shop our selection of fresh and delicious milk'), (4, 'Eggs', 'eggs', 'A dozen farm-fresh eggs', 'These eggs are sourced from local farms and are guaranteed to be fresh and delicious. They are perfect for cooking, baking, or making breakfast.', 3.49, 2.99, 'eggs.jpg', 50, 1, 1, 'Eggs - Fresh and Delicious', 'eggs, fresh, delicious', 'Shop our selection of fresh and delicious eggs'), (4, 'Bread', 'bread', 'A loaf of freshly-baked bread', 'This loaf of bread is baked fresh daily and is made with high-quality ingredients. It is perfect for sandwiches, toast, or making croutons.', 2.99, 2.49, 'bread.jpg', 50, 1, 1, 'Bread - Freshly-Baked', 'bread, freshly-baked', 'Shop our selection of freshly-baked bread'), 

(5, 'Laptop', 'laptop', 'A high-performance laptop', 'This laptop is equipped with a powerful processor, a high-resolution display, and a long-lasting battery. It is perfect for work, entertainment, or gaming.', 999.99, 899.99, 'laptop.jpg', 50, 1, 1, 'Laptop - High Performance', 'laptop, high performance', 'Shop our selection of high-performance laptops'), (5, 'Desktop Computer', 'desktop-computer', 'A powerful desktop computer', 'This desktop computer is equipped with a powerful processor, a high-resolution monitor, and a variety of connectivity options. It is perfect for work, entertainment, or gaming.', 799.99, 699.99, 'desktop-computer.jpg', 50, 1, 1, 'Desktop Computer - Powerful', 'desktop computer, powerful', 'Shop our selection of powerful desktop computers'), (5, 'Monitor', 'monitor', 'A high-resolution monitor', 'This monitor is equipped with a high-resolution display and a variety of connectivity options. It is perfect for work, entertainment, or gaming.', 499.99, 399.99, 'monitor.jpg', 50, 1, 1, 'Monitor - High Resolution', 'monitor, high resolution', 'Shop our selection of high-resolution monitors'), 

(6, 'Earrings', 'earrings', 'A pair of beautiful and stylish earrings', 'These earrings are made of high-quality materials and feature a unique design. They are perfect for dressing up any outfit.', 29.99, 19.99, 'earrings.jpg', 50, 1, 1, 'Earrings - Beautiful and Stylish', 'earrings, beautiful, stylish', 'Shop our selection of beautiful and stylish earrings'), (6, 'Bracelet', 'bracelet', 'A beautiful and stylish bracelet', 'This bracelet is made of high-quality materials and features a unique design. It is perfect for dressing up any outfit.', 39.99, 29.99, 'bracelet.jpg', 50, 1, 1, 'Bracelet - Beautiful and Stylish', 'bracelet, beautiful, stylish', 'Shop our selection of beautiful and stylish bracelets'), (6, 'Handbag', 'handbag', 'A stylish and practical handbag', 'This handbag is made of high-quality materials and features a stylish design. It is perfect for carrying all of your essentials in style.', 79.99, 69.99, 'handbag.jpg', 50, 1, 1, 'Handbag - Stylish and Practical', 'handbag, stylish, practical', 'Shop our selection of stylish and practical handbags'), 

(7, 'Television', 'television', 'A high-definition television', 'This television is equipped with a high-definition display and a variety of connectivity options. It is perfect for watching movies, TV shows, or sports.', 499.99, 399.99, 'television.jpg', 50, 1, 1, 'Television - High Definition', 'television, high definition', 'Shop our selection of high-definition televisions'), (7, 'Sound System', 'sound-system', 'A high-quality sound system', 'This sound system is equipped with powerful speakers and a variety of connectivity options. It is perfect for listening to music, watching movies, or hosting parties.', 399.99, 299.99, 'sound-system.jpg', 50, 1, 1, 'Sound System - High Quality', 'sound system, high quality', 'Shop our selection of high-quality sound systems'), (7, 'Streaming Device', 'streaming-device', 'A device for streaming movies, TV shows, and more', 'This streaming device is equipped with a variety of apps and features for streaming movies, TV shows, music, and more. It is perfect for entertainment on demand.', 99.99, 79.99, 'streaming-device.jpg', 50, 1, 1, 'Streaming Device - Entertainment On Demand', 'streaming device, entertainment, on demand', 'Shop our selection of streaming devices for entertainment on demand');


Dropping Table:
DROP TABLE Products;
DROP TABLE Categories;