<?php
    session_start();
    require_once(__DIR__ . '/php/navbar.tpl.php');
    require_once(__DIR__ . '/php/data_fetch.php');
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT * FROM Items ORDER BY RANDOM() LIMIT 8");
    $stmt->execute();
    $items = $stmt->fetchAll();
    $stmt = $db->prepare ("SELECT * FROM Categories Limit 5");
    $stmt->execute();
    $categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand</title>
    <link rel="stylesheet" href="css/index-style.css">
    <link rel="stylesheet" href="css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<?php drawNavbar($_SESSION) ?>
    <main>
        <h1> FEATURED ITEMS </h1>
        <div class="featured">
            <?php
            foreach ($items as $item) {
                $image = fetchFirstImageIndex($item['item_id']);
                echo "<article>
                <div class='imgbox'>
                    <img src='" . $image . "'>
                </div>
                <a class='title' href='pages/item.php?id=" . $item['item_id'] . "'>" . $item['title'] . "</a>
                <p class ='small-text'>" . $item['location'] . "</p>
                <p class ='small-text'>Published " . $item['publish_date'] . "</p>
            </article>";
            } ?>
            </div>
            <h1>Categories</h1>
            <div class="categories">
            <?php
            foreach ($categories as $category) {
                echo "<div class='category'>
                        <img class='background' src='" . $category['image_url'] . "'>
                        <a href='search.php?category=" . $category['categoria_id'] . "' class='category-title'>" . $category['nome'] . "</a>
                    </div>";
            }
            ?>
        </div>
        <footer>
            <div class="footer-content">
                <a class="logo" href="index.php">Hand2Hand</a>
            </div>
        </footer>
    </main>
</body>