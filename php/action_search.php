<?php 
function searchItems(PDO $db, string $query, $page) {
    $query = trim($query);

    if (empty($query)) {
        return [];
    }

    $offset = ($page - 1) * 5;

    $stmt = $db->prepare('SELECT * FROM Items WHERE title LIKE :query LIMIT 5 OFFSET :offset');
    $query = '%' . $query . '%';
    $stmt->bindParam(':query', $query);
    $stmt->bindParam(':offset', $offset);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function pageCount(PDO $db, string $query) {
    $query = trim($query);

    if (empty($query)) {
        return 0;
    }

    $stmt = $db->prepare('SELECT * FROM Items WHERE title LIKE :query');
    $query = '%' . $query . '%';
    $stmt->bindParam(':query', $query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $numOfItems = count($result);
    if ($numOfItems == 0) {
        return 0;
    }
    $numOfPages = ceil($numOfItems / 5);
    return $numOfPages;
}
?>