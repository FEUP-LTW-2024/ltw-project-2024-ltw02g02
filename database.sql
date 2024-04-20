DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Carts;

CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    pfp_url TEXT DEFAULT "images/userdefault.jpg",
    password TEXT NOT NULL
);

CREATE TABLE Items (
    item_id INTEGER PRIMARY KEY AUTOINCREMENT,
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
(1, 'user1', 'user1@example.com', '$2y$10$hzKLPw0J4eV5oM4ZUfcE3e.Z9bjl9xj0wx9HMisHUTS3MUEGETLQW'),
(2, 'user2', 'user2@example.com', '$2y$10$c2SNCgaMaY1BZbVR5/GOO.FtOtPZIfxG5veQ1iNCDZrDe6WmiANB2'),
(3, 'user3', 'user3@example.com', '$2y$10$HLePLN/dZ1ESgnjYfSIObuwYdtPQgeUTR5s/t0D/U1oa5o55f93aS'),
(4, 'user4', 'user4@example.com', '$2y$10$hPcqM3IYFwU78vX2ajx1velGiByPHzL7sA45tuKcPLFq.7BF4.i96'),
(5, 'user5', 'user5@example.com', '$2y$10$ukqBVYcE1CCHf0M4GJAUD.4UtE23I.2MEeFKtcWr7jBbLmtC2gvVm');

INSERT INTO Users (user_id, username, email, password, pfp_url) VALUES
(6, 'Luis_Figo','luisfigoperdetudo@sporting.pt','$2y$10$27FzWMYrfrGo7J/DffeMHuUF6bh1x4vjRH86cRRdohKY9KpZR.io.','images/luisfigo.webp');

INSERT INTO Items (seller_id, title, description, price, condition, category, location, publish_date, image_url) VALUES
(1, 'Used Laptop', 'Gently used laptop with Intel Core i5 processor', 500.00, 'Good', 'Electronics', 'New York', datetime('now', '-1 day'), 'images/laptop.jpg'),
(2, 'Smartphone', 'Brand new smartphone with latest features', 700.00, 'Excellent', 'Electronics', 'Los Angeles', datetime('now', '-2 days'), 'images/phone.webp'),
(3, 'Vintage Watch', 'Classic vintage watch in pristine condition', 300.00, 'Like New', 'Accessories', 'Chicago', datetime('now', '-3 days'), 'images/watch.jpg'),
(4, 'Gaming Console', 'Used gaming console with controllers and games', 250.00, 'Good', 'Electronics', 'Houston', datetime('now', '-4 days'), 'images/ps2.webp'),
(5, 'Bicycle', 'Mountain bike suitable for off-road trails', 450.00, 'Fair', 'Sports', 'San Francisco', datetime('now', '-5 days'), 'images/bicycle.jpg'),
(6, 'Luís','O Homem está se a vender visto que não lhe resta nada (Perde tudo)', 999.99,'Used','Luis Figo','Lisboa', datetime('now','-370 days'), 'images/luisfigo.webp');

