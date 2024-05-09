<?php
session_start();

$db = new PDO("sqlite:../database.db");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $data = json_decode(file_get_contents('php://input'), true);

    $item_id = $data['item_id'];
    $user_id = $data['user_id'];

    $stmt = $db->prepare("SELECT COUNT(*) FROM Wishlist WHERE item_id = :item_id AND user_id = :user_id");
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    echo json_encode(array("exists" => ($count > 0)));
} else {
    echo json_encode(array("exists" => false));
}
?>