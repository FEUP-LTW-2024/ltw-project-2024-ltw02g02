DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Carts;

CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);

CREATE TABLE Items (
    item_id INTEGER PRIMARY KEY,
    seller_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT,
    price REAL,
    condition TEXT,
    category TEXT,
    location TEXT,
    publish_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    image_url TEXT,
    FOREIGN KEY (seller_id) REFERENCES Users(user_id)
);

CREATE TABLE Carts (
    cart_id INTEGER PRIMARY KEY ,
    user_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (item_id) REFERENCES Items(item_id)
);

INSERT INTO Users (user_id, username, email, password) VALUES 
(1, 'user1', 'user1@example.com', 'password1'),
(2, 'user2', 'user2@example.com', 'password2'),
(3, 'user3', 'user3@example.com', 'password3'),
(4, 'user4', 'user4@example.com', 'password4'),
(5, 'user5', 'user5@example.com', 'password5');

INSERT INTO Items (seller_id, title, description, price, condition, category, location, publish_date, image_url) VALUES
(1, 'Used Laptop', 'Gently used laptop with Intel Core i5 processor', 500.00, 'Good', 'Electronics', 'New York', datetime('now', '-1 day'), 'images/laptop.jpg'),
(2, 'Smartphone', 'Brand new smartphone with latest features', 700.00, 'Excellent', 'Electronics', 'Los Angeles', datetime('now', '-2 days'), 'images/phone.webp'),
(3, 'Vintage Watch', 'Classic vintage watch in pristine condition', 300.00, 'Like New', 'Accessories', 'Chicago', datetime('now', '-3 days'), 'images/watch.jpg'),
(4, 'Gaming Console', 'Used gaming console with controllers and games', 250.00, 'Good', 'Electronics', 'Houston', datetime('now', '-4 days'), 'images/ps2.webp'),
(5, 'Bicycle', 'Mountain bike suitable for off-road trails', 450.00, 'Fair', 'Sports', 'San Francisco', datetime('now', '-5 days'), 'images/bicycle.jpg');

