<?php
session_start();
$db = new PDO("sqlite:../database.db");
$db->exec('PRAGMA foreign_keys = ON;');

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    $stmt = $db->prepare('DELETE FROM Items WHERE item_id = :item_id');
    $stmt->bindParam(':item_id', $item_id);
    
    $result = $stmt->execute();
    if ($result) {
        header("Location: ../pages/profile.php");
        exit;
    } else {
        $errorMessage = "Error deleting item!";
        header("Location: ../pages/profile.php?error=" . urlencode($errorMessage));
        exit;
    }
} else {
    $errorMessage = "Nem encontrou!";
    header("Location: ../pages/profile.php?error=" . urlencode($errorMessage));
    exit;
}
