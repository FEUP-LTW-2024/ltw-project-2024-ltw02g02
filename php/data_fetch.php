<?php 
function fetchWishlist(PDO $db, $user_id) {
    $stmt = $db->prepare("SELECT Items.* FROM Wishlist JOIN Items ON Wishlist.item_id = Items.item_id WHERE Wishlist.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $wishlist = $stmt->fetchAll();
    return $wishlist;
}

function fetchAllImages(PDO $db, $item_id) {
    $stmt = $db->prepare("SELECT image_url FROM Images WHERE item_id = :item_id");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $images = $stmt->fetchAll();
    if (count($images) < 1) {
        $images[]['image_url'] = '../images/no-image.png';
    }
    return $images;
}

function fetchFirstImage(PDO $db, $item_id) {
    $stmt = $db->prepare("SELECT image_url FROM Images WHERE item_id = :item_id LIMIT 1");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $image = $stmt->fetch();
    if ($image === false) {
        $image = '../images/no-image.png';
        return $image;
    }
    return $image[0];
}

function fetchItem(PDO $db, $item_id) {
    $stmt = $db->prepare("SELECT * FROM Items WHERE item_id = :id");
    $stmt->bindParam(":id",$item_id);
    $stmt->execute();
    $item = $stmt->fetch();
    return $item;
}

function fetchSeller(PDO $db, $seller_id) {
    $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
    $stmt->bindParam(":id",$seller_id);
    $stmt->execute();
    $seller = $stmt->fetch();
    return $seller;
}

function fetchPFP(PDO $db, $user_id) {
    $stmt = $db->prepare("SELECT pfp_url FROM Users WHERE user_id = :id");
    $stmt->bindParam(":id",$user_id);
    $stmt->execute();
    $pfp_url = $stmt->fetchColumn();
    if (!$pfp_url || !file_exists($pfp_url)) {
        $pfp_url = '../images/userdefault.jpg';
    }
    return $pfp_url;
}

function fetchListings(PDO $db, $user_id) {
    $stmt = $db->prepare("SELECT item_id,title,publish_date FROM Items WHERE seller_id = :id");
    $stmt->bindParam(":id",$user_id);
    $stmt->execute();
    $listings = $stmt->fetchAll();
    return $listings;
}

function formatPrice($price,$currency) {
    $price = number_format($price,2,".","");
    switch ($currency) {
        case 'EUR':
            $formattedPrice = $price . ' €';
            break;
        case 'USD':
            $formattedPrice = '$ ' . $price;
            break;
        case 'AUD':
            $formattedPrice = 'AU$ ' . $price;
            break;
        case 'CAD':
            $formattedPrice = 'CA$ ' . $price;
            break;
        case 'GBP':
            $formattedPrice = '£ ' . $price;
            break;
        case 'YEN':
            $formattedPrice = $price . ' ¥' ;
            break;
        case 'BRL':
            $formattedPrice = 'R$ ' . $price;
            break;
    }
    return $formattedPrice;
}

function wishlistCheck(PDO $db, $user_id, $item_id) {
    $stmt = $db->prepare('SELECT * FROM Wishlist WHERE user_id = :user_id AND item_id = :item_id');
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $count = count($stmt->fetchAll());
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function userExists($username) {
    $dbh = new PDO('sqlite:../database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function emailExists($email) {
    $dbh = new PDO('sqlite:../database.db');
    $stmt = $dbh->prepare("SELECT * FROM Users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch() !== false;
}

function fetchAttributes(PDO $db, $item_id) {
    $itemAttributes = [];
    $stmt = $db->prepare('SELECT i.item_id as id,ia.attribute_id as attribute,ia.value as value FROM Items i Join ItemAttributes ia ON i.item_id = ia.item_id WHERE i.item_id = :item_id');
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        $itemAttributes[$row['attribute']] = $row['value'];
    }
    return $itemAttributes;
}

function getAttributeName(PDO $db, $attribute_id) {
    $stmt = $db->prepare('SELECT name FROM Attributes WHERE attribute_id = :attribute_id');
    $stmt->bindParam(':attribute_id', $attribute_id);
    $stmt->execute();
    $name = $stmt->fetch();
    return $name['name'];
}

function getCategoryName(PDO $db, $category_id) {
    $stmt = $db->prepare('SELECT name FROM Categories WHERE category_id = :category_id');
    $stmt->bindParam(':category_id', $category_id);
    $stmt->execute();
    $name = $stmt->fetch();
    return $name['name'];
}

function fetchChatUsers($db, $user_id) {
    $stmt = $db->prepare('SELECT DISTINCT u.user_id, u.username FROM users u JOIN messages m ON u.user_id = m.sender_id OR u.user_id = m.recipient_id WHERE (m.sender_id = :user_id OR m.recipient_id = :user_id) AND u.user_id != :user_id');
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchMessages($db, $user_id, $contact_id) {
    $stmt = $db->prepare("SELECT * FROM messages WHERE (sender_id = :user_id AND recipient_id = :contact_id)
                          OR (sender_id = :contact_id AND recipient_id = :user_id) ORDER BY timestamp ASC");
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':contact_id', $contact_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

function fetchContacts($db, $userId) {
    $query = "SELECT DISTINCT u.user_id, u.username, u.pfp_url FROM Users u 
              JOIN Messages m ON u.user_id = m.sender_id OR u.user_id = m.recipient_id 
              WHERE (m.sender_id = :userId OR m.recipient_id = :userId) AND u.user_id != :userId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetchAll();
}

?>