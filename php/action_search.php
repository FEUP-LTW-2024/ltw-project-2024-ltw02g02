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

function fetchAttributes(PDO $db, $item_id) {
    $itemAttributes = [];
    $stmt = $db->prepare('SELECT i.item_id as id,ia.attribute_id as attribute,ia.value as value FROM Items i Join ItemAttributes ia ON i.item_id = ia.item_id WHERE i.item_id = :item_id');
    $stmt->bindParam(':item_id', $item_id);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        $itemAttributes[$row['attribute']] = $row['value'];
    }
    return $itemAttributes;
}

function filteredResult(PDO $db, $data) {
    $query = $data['q'];
    $stmt = $db->prepare('SELECT * FROM Items WHERE title LIKE :query');
    $query = '%' . $query . '%';
    $stmt->bindParam(':query', $query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $filteredResult = [];
    foreach ($result as $item) {
        if (isset($data['category'])) {
            if ($data['category'] == $item['category_id']) {
                $itemAttributes = fetchAttributes($db, $item['item_id']);
                foreach ($data as $attribute => $value) {
                    if (strpos($attribute, 'attribute_') === 0) {
                        $attribute_id = substr($attribute, strlen('attribute_'));
                        if (($value != '') AND ($itemAttributes[$attribute_id] !== $value)) {
                            continue;
                        }
                    }
                }
            } else {
                continue;
            }
        }
        if (isset($data['condition'])) {
            if ($data['condition']!== $item['condition']) {
                continue;
            }
        }

        if ($data['price'] !== '') {
            if (floatval($data['price']) < floatval($item['price'])) {
                continue;
            }
        }
        array_push($filteredResult, $item);
    }
    return $filteredResult;
}