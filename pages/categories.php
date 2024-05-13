<?php
    session_start();
    require_once(__DIR__ . '/../php/navbar.tpl.php');
    $db = new PDO("sqlite:" . __DIR__ . "/../database.db");
    $stmt = $db->prepare("SELECT * FROM Categories");
    $stmt->execute();
    $categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Categories</title>
    <link rel="stylesheet" href="../css/categories-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<?php drawNavbar($_SESSION) ?>
    <main>
        <h1> Categories </h1>
        <div class="categories">
            <?php
            foreach ($categories as $category) {
                echo "<article class='category-card'>
                <img src='/" . $category['icon_url'] . "' alt='" . $category['nome'] . " icon' class='category-icon'>
                <a class='title' href='category.php?id=" . $category['categoria_id'] . "'>" . $category['nome'] . "</a>
                </article>";
            }
            ?>
        </div>
    </main>
</body>
</html>