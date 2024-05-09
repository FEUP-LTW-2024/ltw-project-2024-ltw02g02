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

?>