<?php
session_start();

$db = new PDO("sqlite:../database.db");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
    $data = json_decode(file_get_contents('php://input'), true);

    $user_id = $data['user_id'];
    $item_id = $data['item_id'];
    if ($data['action'] == 'add') {
        $stmt = $db->prepare("INSERT INTO Wishlist (user_id, item_id) VALUES (:user_id, :item_id)");
    } else if ($data['action'] == 'remove') {
        $stmt = $db->prepare("DELETE FROM Wishlist WHERE user_id = :user_id AND item_id = :item_id");
    }
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':item_id', $item_id);
    $success = $stmt->execute();
    echo json_encode(array("success" => $success));
} else {
    echo json_encode(array("success" => false));
}
?>