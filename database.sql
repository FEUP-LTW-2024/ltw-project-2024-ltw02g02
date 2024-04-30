DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Categories;



CREATE TABLE Users (
    user_id INTEGER PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    pfp_url TEXT DEFAULT '../images/userdefault.jpg',
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
    image_url VARCHAR,
    FOREIGN KEY (seller_id) REFERENCES Users(user_id)
);

CREATE TABLE Categories (
    categoria_id INTEGER PRIMARY KEY,
    nome TEXT NOT NULL UNIQUE,
    image_url VARCHAR
);

INSERT INTO Categories (nome, image_url) VALUES 
('Vehicles', 'images/vehicles.jpg'),
('Clothing', 'images/cloths.jpg'),
('Technology', 'images/tech.jpg'),
('Sports', 'images/sports.jpg'),
('Literature', 'images/books.jpg'),
('Books', 'images/books_stripe.jpg'),
('Home & Garden', 'images/home_garden_stripe.jpg'),
('Toys & Games', 'images/toys_games_stripe.jpg'),
('Other', 'images/other_stripe.jpg');

INSERT INTO Users (username, email, password) VALUES
    ('user1', 'user1@example.com', 'password1'),
    ('user2', 'user2@example.com', 'password2'),
    ('user3', 'user3@example.com', 'password3'),
    ('user4', 'user4@example.com', 'password4'),
    ('user5', 'user5@example.com', 'password5');

INSERT INTO Items (seller_id, title, description, price, condition, category, location, image_url) VALUES
    (1, 'Item 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sed purus quis urna scelerisque fermentum. Integer nec volutpat justo. Sed volutpat, risus et ultrices molestie, dolor mi pharetra nisi, vel consequat risus urna nec leo. Aliquam non tellus enim. Fusce aliquam varius mi vitae pellentesque. Nam in magna nec orci rhoncus convallis. Nulla vitae libero nunc. Fusce pretium sit amet libero id tristique. Integer in metus ac ligula consequat feugiat. Vestibulum vel congue enim. Donec fermentum dignissim magna at hendrerit.', 10.99, 'New', 'Category 1', 'Location 1', 'https://picsum.photos/200/300,https://picsum.photos/400/500,https://picsum.photos/600/700,https://picsum.photos/800/900'),
    (1, 'Item 2', 'Suspendisse potenti. Morbi ut scelerisque purus. Duis vel mi eget ligula pulvinar auctor in in ipsum. Nulla nec dictum odio. Nulla facilisi. Morbi eget convallis lorem. Phasellus vulputate tortor non eros facilisis sollicitudin. Cras id lorem sit amet justo varius fermentum. Ut non tellus ligula. Vivamus tristique metus nec elit cursus, nec pharetra libero tristique. Proin vitae justo ut arcu sagittis egestas. Proin porttitor, nisl vitae vehicula blandit, purus lorem sollicitudin eros, in elementum ipsum felis at risus.', 20.49, 'Used', 'Category 2', 'Location 2', 'https://picsum.photos/300/400,https://picsum.photos/500/600,https://picsum.photos/700/800,https://picsum.photos/900/1000'),
    (2, 'Item 3', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla facilisi. Nam tincidunt purus id massa vehicula, vel accumsan urna consectetur. Nullam sit amet erat et metus efficitur facilisis. Aliquam erat volutpat. Fusce fringilla laoreet felis, nec euismod purus. Cras auctor, ligula in faucibus tristique, libero velit pellentesque metus, et sollicitudin leo leo id lectus. Mauris scelerisque orci et commodo aliquam. Donec commodo tincidunt mi, eu vestibulum odio volutpat non. Cras euismod dolor in lectus bibendum, vel volutpat justo aliquet. Mauris eget ligula vitae ante bibendum vestibulum. In vel arcu sed sapien malesuada eleifend id sit amet mi. Integer facilisis metus nec magna accumsan efficitur. Cras ac interdum felis. Donec eu augue in nisi eleifend malesuada et eu nunc.', 15.75, 'New', 'Category 3', 'Location 3', 'https://picsum.photos/400/500,https://picsum.photos/600/700,https://picsum.photos/800/900,https://picsum.photos/1000/1100'),
    (2, 'Item 4', 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin vulputate erat a lectus ultrices, a iaculis libero fringilla. Suspendisse sem justo, aliquet sed sem quis, tristique tincidunt ipsum. Donec sed sem vel lacus interdum ultricies. Vestibulum sodales semper dapibus. Mauris nec lorem non purus ultrices sollicitudin id nec risus. Cras vel nunc lacinia, fermentum magna et, elementum eros. Vestibulum nec quam eu turpis pharetra vehicula. Sed malesuada erat et elit dictum, id facilisis velit gravida. Nam sodales lacus nec urna accumsan, eu mollis lectus accumsan. Donec tristique sodales eros, vitae pellentesque risus. Nam ac nibh enim. Duis lacinia, libero quis congue semper, sem est scelerisque dui, eu dapibus sapien est id orci.', 30.25, 'Used', 'Category 4', 'Location 4', 'https://picsum.photos/500/600,https://picsum.photos/700/800,https://picsum.photos/900/1000,https://picsum.photos/1100/1200'),
    (3, 'Item 5', 'Nunc feugiat lorem eu ligula viverra dignissim. Integer euismod sem at sem congue egestas. Cras fringilla odio a nulla luctus, nec consequat dui condimentum. Proin bibendum, mauris sit amet consectetur convallis, urna mi commodo turpis, ut luctus justo ante vel nisi. Donec at erat eu lectus dapibus consequat non nec erat. Donec pulvinar orci id tortor facilisis, id vestibulum ipsum aliquet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget felis tristique, aliquet purus eu, tempus lorem. Suspendisse potenti. Morbi quis nisl et sapien rutrum blandit.', 12.99, 'New', 'Category 5', 'Location 5', 'https://picsum.photos/600/700,https://picsum.photos/800/900,https://picsum.photos/1000/1100,https://picsum.photos/1200/1300'),
    (3, 'Item 6', 'Nullam at tortor a nulla bibendum elementum. Aenean placerat lacinia risus id condimentum. Cras sed turpis sit amet ex tempor volutpat. Nam condimentum lectus ac commodo ullamcorper. Mauris tincidunt vel justo vitae faucibus. Aenean efficitur sagittis sem, id dictum nisl. Morbi in libero sollicitudin, posuere turpis eget, cursus orci. Nulla eget lacus non arcu facilisis gravida. Donec venenatis a ex ac consectetur. Nullam vel leo ac eros elementum fermentum vel eget libero. Cras ullamcorper consequat nibh, vitae venenatis ante pharetra sit amet. Sed eget odio rhoncus, dapibus est eu, convallis urna. Donec luctus semper justo, et ultricies libero pellentesque id. Duis volutpat, est sit amet laoreet varius, justo nulla varius sem, non ultricies arcu arcu at eros.', 25.50, 'Used', 'Category 6', 'Location 6', 'https://picsum.photos/700/800,https://picsum.photos/900/1000,https://picsum.photos/1100/1200,https://picsum.photos/1300/1400'),
    (4, 'Item 7', 'Sed sagittis quam eget commodo tincidunt. Curabitur gravida lacus velit, eget sodales velit tristique eget. Sed auctor malesuada eros, vel malesuada odio hendrerit a. Morbi at leo nec justo maximus rutrum eu ac risus. Integer in metus orci. Curabitur pulvinar, elit a ullamcorper pellentesque, nisl nisi aliquam sem, eu gravida quam ipsum vitae libero. Aliquam fermentum feugiat sodales. In hac habitasse platea dictumst. Mauris nec convallis mi. Nulla euismod magna et libero malesuada efficitur. Aenean eu odio vel odio eleifend pretium. Vestibulum et diam non dolor maximus venenatis. Nulla facilisi. Nam et semper mi. Integer mattis justo purus, ac sodales libero efficitur in. Nullam ac velit eget purus suscipit tristique.', 18.75, 'New', 'Category 7', 'Location 7', 'https://picsum.photos/800/900,https://picsum.photos/1000/1100,https://picsum.photos/1200/1300,https://picsum.photos/1400/1500'),
    (4, 'Item 8', 'Phasellus in posuere ligula. In hac habitasse platea dictumst. Integer ut volutpat mi. Vestibulum scelerisque velit ut vehicula sollicitudin. Nulla facilisi. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras in gravida velit. Integer vel lectus elementum, volutpat neque ut, accumsan dolor. Aenean laoreet laoreet mauris. Vivamus quis condimentum nisl. Suspendisse vitae diam eu arcu interdum accumsan id nec arcu. Ut faucibus, ipsum id blandit aliquam, elit nunc vestibulum turpis, eget facilisis arcu leo in nisi. Vestibulum sit amet urna quis sapien hendrerit varius. Curabitur vestibulum eros ligula, eu fringilla lacus tempus in. Donec vitae ex ligula. Vivamus vel convallis ipsum.', 35.99, 'Used', 'Category 8', 'Location 8', 'https://picsum.photos/900/1000,https://picsum.photos/1100/1200,https://picsum.photos/1300/1400,https://picsum.photos/1500/1600'),
    (5, 'Item 9', 'Praesent consequat dolor at scelerisque bibendum. Suspendisse potenti. Nam aliquam nisi in felis bibendum, non vehicula enim fermentum. In facilisis ipsum et ante egestas, nec feugiat odio tincidunt. Sed rhoncus nec justo sed dignissim. Proin id lorem a eros eleifend tristique. Vestibulum vitae urna eu mi ultrices fermentum. Maecenas ut interdum sem, eget egestas lectus. Vivamus non suscipit libero. Fusce eget nunc vel leo luctus tincidunt. Nullam non ullamcorper ligula. Duis hendrerit nulla id bibendum rhoncus. Curabitur tristique elit a odio ultricies, ut volutpat velit vestibulum. Phasellus rhoncus libero et urna congue, nec tincidunt quam malesuada. Aenean nec tincidunt eros. Vivamus gravida, nisi nec molestie luctus, enim libero fermentum lorem, a rhoncus dolor neque vel purus.', 14.50, 'New', 'Category 9', 'Location 9', 'https://picsum.photos/1000/1100,https://picsum.photos/1200/1300,https://picsum.photos/1400/1500,https://picsum.photos/1600/1700'),
    (5, 'Item 10', 'Donec ac magna non nunc gravida tristique. Duis vehicula arcu eu risus cursus, non luctus turpis hendrerit. Aliquam nec posuere mauris. Nulla facilisi. Morbi non leo a dui hendrerit vehicula a eget risus. Sed non sagittis ipsum. Nam tempor turpis sed nisi pharetra, et efficitur nulla posuere. Duis et tincidunt mi. Sed volutpat nisi non dolor lacinia vehicula. Ut eleifend leo in arcu euismod, ac bibendum elit elementum. Aliquam commodo rhoncus ante eu euismod. Aenean vitae nisi a quam ullamcorper sollicitudin. Ut tincidunt, arcu nec faucibus volutpat, ante velit varius velit, a dictum lacus mi non libero. Donec sed dui eget elit hendrerit dapibus. Phasellus at tortor non tortor malesuada convallis. Fusce vel nibh lobortis, scelerisque diam sit amet, fermentum mi.', 40.25, 'Used', 'Category 10', 'Location 10', 'https://picsum.photos/1100/1200,https://picsum.photos/1300/1400,https://picsum.photos/1500/1600,https://picsum.photos/1700/1800');