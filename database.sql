DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Attributes;
DROP TABLE IF EXISTS ItemAttributes;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Images;

CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    join_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    pfp_url TEXT DEFAULT '../images/userdefault.jpg',
    password TEXT NOT NULL
);

CREATE TABLE Categories (
    category_id INTEGER PRIMARY KEY,
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE Items (
    item_id INTEGER PRIMARY KEY,
    seller_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    title TEXT NOT NULL,
    description TEXT,
    price REAL,
    condition TEXT,
    currency TEXT DEFAULT 'EUR',
    cellphone TEXT,
    location TEXT,
    publish_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE
);

CREATE TABLE Attributes (
    attribute_id INTEGER PRIMARY KEY,
    category_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    data_type TEXT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES Categories(category_id) ON DELETE CASCADE
);

CREATE TABLE ItemAttributes (
    ia_id INTEGER PRIMARY KEY,
    attribute_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    value TEXT NOT NULL,
    FOREIGN KEY (attribute_id) REFERENCES Attributes(attribute_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Items(item_id) ON DELETE CASCADE
);

CREATE TABLE Wishlist (
    wishlist_id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    item_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES Items(item_id) ON DELETE CASCADE
);

CREATE TABLE Images (
    image_id INTEGER PRIMARY KEY,
    item_id INTEGER NOT NULL,
    image_url TEXT,
    FOREIGN KEY (item_id) REFERENCES Items(item_id) ON DELETE CASCADE
);

CREATE TABLE Messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    sender_id INTEGER NOT NULL,
    recipient_id INTEGER NOT NULL,
    content TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users (user_id),
    FOREIGN KEY (recipient_id) REFERENCES users (user_id)
);

INSERT INTO Categories (name) VALUES 
    ('Vehicles'),
    ('Clothing'),
    ('Technology'),
    ('Sports'),
    ('Literature'), 
    ('Books'),
    ('Home & Garden'),
    ('Toys & Games'),
    ('Other');

INSERT INTO Users (username, email, password) VALUES
    ('user1', 'user1@example.com', 'password1'),
    ('user2', 'user2@example.com', 'password2'),
    ('user3', 'user3@example.com', 'password3'),
    ('user4', 'user4@example.com', 'password4'),
    ('user5', 'user5@example.com', 'password5'),
    ('example','example@example.com','$2y$10$lG2sgYIGzOT/jPNiHF2A2.nm3DTKdbm6CYrZQ/vc/nRWFNiGgRaFK');

INSERT INTO Items (seller_id, title, description, price, condition, category_id, cellphone, location) VALUES
    (1, 'Toyota Camry', 'A well-maintained car', 15000, 'Fair', 1, '+351 912345678', 'Lisboa'),
    (1, 'Nike Jacket', 'Warm and stylish jacket', 50.99, 'Like New', 2, '+351 912345679', 'Porto'),
    (2, 'iPhone 12', 'Latest model, excellent condition', 799.99, 'Like New', 3, '+351 912345680', 'Faro'),
    (2, 'Tennis Racket', 'Professional level racket', 150.00, 'Good', 4, '+351 912345681', 'Coimbra'),
    (3, 'Harry Potter Book Set', 'Complete collection', 120.75, 'Brand New', 5, '+351 912345682', 'Braga'),
    (3, 'Cookbook', 'Recipes for all occasions', 25.50, 'Poor', 6, '+351 912345683', 'Aveiro'),
    (4, 'Garden Shovel', 'Heavy duty garden shovel', 18.75, 'Fair', 7, '+351 912345684', 'Évora'),
    (4, 'Board Game', 'Fun for the whole family', 35.99, 'Good', 8, '+351 912345685', 'Guarda'),
    (5, 'Mystery Novel', 'Thrilling and captivating', 14.50, 'Like New', 9, '+351 912345686', 'Leiria'),
    (5, 'Vintage Car Model', "Collector's item", 40.25, 'Like New', 9, '+351 912345687', 'Santarém');

INSERT INTO Images (item_id, image_url) VALUES 
    (1, 'https://picsum.photos/200/300'),
    (1, 'https://picsum.photos/400/500'),
    (1, 'https://picsum.photos/600/700'),
    (1, 'https://picsum.photos/800/900'),
    (2, 'https://picsum.photos/300/400'),
    (2, 'https://picsum.photos/500/600'),
    (2, 'https://picsum.photos/700/800'),
    (2, 'https://picsum.photos/900/1000'),
    (3, 'https://picsum.photos/400/500'),
    (3, 'https://picsum.photos/600/700'),
    (3, 'https://picsum.photos/800/900'),
    (3, 'https://picsum.photos/1000/1100'),
    (4, 'https://picsum.photos/500/600'),
    (4, 'https://picsum.photos/700/800'),
    (4, 'https://picsum.photos/900/1000'),
    (4, 'https://picsum.photos/1100/1200'),
    (5, 'https://picsum.photos/600/700'),
    (5, 'https://picsum.photos/800/900'),
    (5, 'https://picsum.photos/1000/1100'),
    (5, 'https://picsum.photos/1200/1300'),
    (6, 'https://picsum.photos/700/800'),
    (6, 'https://picsum.photos/900/1000'),
    (6, 'https://picsum.photos/1100/1200'),
    (6, 'https://picsum.photos/1300/1400'),
    (7, 'https://picsum.photos/800/800'),
    (7, 'https://picsum.photos/1000/1100'),
    (7, 'https://picsum.photos/1200/1300'),
    (7, 'https://picsum.photos/1400/1500'),
    (8, 'https://picsum.photos/900/1000'),
    (8, 'https://picsum.photos/1100/1200'),
    (8, 'https://picsum.photos/1300/1400'),
    (8, 'https://picsum.photos/1500/1600'),
    (9, 'https://picsum.photos/1000/1100'),
    (9, 'https://picsum.photos/1200/1300'),
    (9, 'https://picsum.photos/1400/1500'),
    (9, 'https://picsum.photos/1600/1700'),
    (10, 'https://picsum.photos/1200/1200'),
    (10, 'https://picsum.photos/1300/1400'),
    (10, 'https://picsum.photos/1500/1600'),
    (10, 'https://picsum.photos/1700/1800');

INSERT INTO Attributes (category_id, name, data_type) VALUES
    (1, 'Mileage', 'number'),
    (1, 'Brand', 'text'),
    (2, 'Size', 'text'),
    (2, 'Material', 'text'),
    (3, 'Brand', 'text'),
    (3, 'Model', 'text'),
    (4, 'Type', 'text'),
    (4, 'Brand', 'text'),
    (5, 'Author', 'text'),
    (5, 'Genre', 'text'),
    (6, 'Author', 'text'),
    (6, 'Publisher', 'text'),
    (7, 'Type', 'text'),
    (7, 'Material', 'text'),
    (8, 'Type', 'text'),
    (8, 'Brand', 'text');

INSERT INTO ItemAttributes (attribute_id, item_id, value) VALUES
    (1, 1, '15000'),
    (2, 1, 'Toyota'),
    (3, 2, 'L'), 
    (4, 2, 'Polyester'),
    (5, 3, 'Apple'), 
    (6, 3, '12'), 
    (7, 4, 'Tennis'), 
    (8, 4, 'Wilson'), 
    (9, 5, 'J.K. Rowling'),
    (10, 5, 'Fantasy'), 
    (11, 6, 'Jamie Oliver'),
    (12, 6, 'Penguin'), 
    (13, 7, 'Garden Tool'),
    (14, 7, 'Steel'),
    (15, 8, 'Board Game'),
    (16, 8, 'Hasbro');