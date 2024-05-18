<?php
session_start();

$db = new PDO('sqlite:../database.db');


if (isset($_POST['title'])) {
    $seller_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $condition = $_POST['condition'];
    $currency = $_POST['currency'];
    $location = $_POST['location'];
    $cellphone = $_POST['cellphone-number'];
    $price = $_POST['price'];
    $stmt = $db->prepare('INSERT INTO Items (seller_id, title, description, price, condition, category, currency, location, cellphone) VALUES (:seller_id,:title,:description,:price,:condition,:category,:currency,:location,:cellphone)');
    $stmt->bindParam(":seller_id", $seller_id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":category", $category);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":condition", $condition);
    $stmt->bindParam(":currency", $currency);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":cellphone", $cellphone);
    $stmt->bindParam(":price", $price);
    $result1 = $stmt->execute();

    if (!empty($_FILES['images']['name'][0])) {
        $item_id = $db->lastInsertId();
        
        $folder = '../images/item-images/';

        $file_names = $_FILES['images']['name'];
        $tmp_names = $_FILES['images']['tmp_name'];
        $files_array = array_combine($tmp_names,$file_names);

        foreach ($files_array as $tmp_name => $file_name) {
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $new_file_name = uniqid() . 'U' . $seller_id . 'I' . $item_id . '.' . $file_extension;
            $new_file_path = $folder . $new_file_name;
            move_uploaded_file($tmp_name, $new_file_path);

            $stmt = $db->prepare('INSERT INTO Images (item_id,image_url) VALUES (:item_id,:image_url)');
            $stmt->bindParam(':item_id', $item_id);
            $stmt->bindParam(':image_url', $new_file_path);
            $result2 = $stmt->execute();
        }

        if (!$result2) {
            $errorMessage = "Error adding images!";
            header("Location: ../pages/selling.php?error=" . urlencode($errorMessage));
            exit;
        }
    }
    
    if ($result1) {
        header("Location: ../index.php");
        exit;
    } else {
        $errorMessage = "Error listing item!";
        header("Location: ../pages/selling.php?error=" . urlencode($errorMessage));
        exit;
    }
}

header("Location: ../index.php");
exit;
