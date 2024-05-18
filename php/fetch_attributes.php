<?php

if (isset($_GET['category'])) {
    $db = new PDO('sqlite:../database.db');
    $category = $_GET['category'];
    $stmt = $db->prepare('SELECT * FROM Attributes WHERE category_id = :category_id');
    $stmt->bindParam(':category_id', $category);
    $stmt->execute();
    $result = $stmt->fetchAll();

    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'No category provided'));
}