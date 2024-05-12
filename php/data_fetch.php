<?php 
function fetchWishlist($user_id) {
    $db = new PDO("sqlite:../database.db");
    $stmt = $db->prepare("SELECT Items.* FROM Wishlist JOIN Items ON Wishlist.item_id = Items.item_id WHERE Wishlist.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $wishlist = $stmt->fetchAll();
    $db = null;
    return $wishlist;
}

function fetchAllImages($item_id) {
    $db = new PDO("sqlite:../database.db");
    $stmt = $db->prepare("SELECT image_url FROM Images WHERE item_id = :item_id");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $images = $stmt->fetchAll();
    $db = null;
    return $images;
}

function fetchFirstImage($item_id) {
    $db = new PDO("sqlite:../database.db");
    $stmt = $db->prepare("SELECT image_url FROM Images WHERE item_id = :item_id LIMIT 1");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $image = $stmt->fetch();
    if ($image === false) {
        $image = '../images/no-image.png';
        return $image;
    }
    $db = null;
    return $image[0];
}

function fetchFirstImageIndex($item_id) {
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT image_url FROM Images WHERE item_id = :item_id LIMIT 1");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $image = $stmt->fetch();
    if ($image === false) {
        $image = '../images/no-image.png';
        return $image;
    }
    $db = null;
    return $image[0];
}

function fetchItem($item_id) {
    $db = new PDO("sqlite:../database.db");
    $stmt = $db->prepare("SELECT * FROM Items WHERE item_id = :id");
    $stmt->bindParam(":id",$item_id);
    $stmt->execute();
    $item = $stmt->fetch();
    $db = null;
    return $item;
}

function fetchSeller($seller_id) {
    $db = new PDO("sqlite:../database.db");
    $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
    $stmt->bindParam(":id",$seller_id);
    $stmt->execute();
    $seller = $stmt->fetch();
    $db = null;
    return $seller;
}

function formatPrice($price,$currency) {
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
?>