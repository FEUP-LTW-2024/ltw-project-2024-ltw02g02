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
    $stmt = $db->prepare('INSERT INTO Items (seller_id, title, description, price, condition, category_id, currency, location, cellphone) VALUES (:seller_id,:title,:description,:price,:condition,:category_id,:currency,:location,:cellphone)');
    $stmt->bindParam(":seller_id", $seller_id);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":category_id", $category);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":condition", $condition);
    $stmt->bindParam(":currency", $currency);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":cellphone", $cellphone);
    $stmt->bindParam(":price", $price);
    $result = $stmt->execute();

    $item_id = $db->lastInsertId();

    if ($result) {  
        foreach ($_POST as $attribute => $value) {
            if (strpos($attribute, 'attribute_') === 0) {
                $attribute_id = substr($attribute, strlen('attribute_'));
                $stmt = $db->prepare('INSERT INTO ItemAttributes (attribute_id, item_id, value) VALUES (:attribute_id, :item_id, :value)');
                $stmt->bindParam(':attribute_id', $attribute_id);
                $stmt->bindParam(':item_id', $item_id);
                $stmt->bindParam(':value', $value);
                $result_attributes = $stmt->execute();
                if (!$result_attributes) {
                    $errorInfo = $stmt->errorInfo();
                    $errorMessage = "Error adding attribute values: " . $errorInfo[2];
                    header("Location: ../pages/selling.php?error=" . urlencode($errorMessage));
                    exit;
                }    
            }
        }
    } else {
        $errorMessage = "Error listing item!";
        header("Location: ../pages/selling.php?error=" . urlencode($errorMessage));
        exit;
    }

    if (!empty($_FILES['images']['name'][0])) {
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
            $result_images = $stmt->execute();
        }

        if (!$result_images) {
            $errorMessage = "Error adding images!";
            header("Location: ../pages/selling.php?error=" . urlencode($errorMessage));
            exit;
        }
    } 
}

header("Location: ../index.php");
exit;
