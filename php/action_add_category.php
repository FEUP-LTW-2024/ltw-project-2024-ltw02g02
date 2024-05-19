<?php
session_start();
if ($_SESSION['is_admin'] !== 1) {
    header('Location: ../not_found.php');
    exit();
}

$db = new PDO("sqlite:../database.db");

if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset( $_POST['name'])) {
    $categoryName = $_POST['name'];
    $categoryName = trim($categoryName);

    if (empty($categoryName)) {
        $errorMessage = 'Invalid Category Name.';
        header('Location: ../pages/admin.php?error=' . urlencode($errorMessage));
    }

    $stmt = $db->prepare('INSERT INTO Categories (name) VALUES (:name)');
    $stmt->bindParam(':name', $categoryName);
    $stmt->execute();
    $categoryId = $db->lastInsertId();

    $attributeNumber = 0;
    while (isset($_POST['attribute_name_' . $attributeNumber])) {
        $attributeName = $_POST['attribute_name_' . $attributeNumber];
        $attributeType = $_POST['attribute_type_' . $attributeNumber];

        if ($attributeName && $attributeType) {
            $stmt = $db->prepare('INSERT INTO Attributes (category_id, name, data_type) VALUES (:category_id, :name, :data_type)');
            $stmt->bindParam(':category_id', $categoryId);
            $stmt->bindParam(':name', $attributeName);
            $stmt->bindParam(':data_type', $attributeType);
            $stmt->execute();
        }

        $attributeNumber++;
    }

    $errorMessage = 'Success!';
    header('Location: ../pages/admin.php?error=' . urlencode($errorMessage));
    exit();
} else {
    header('Location: ../not_found.php');
    exit();
}

