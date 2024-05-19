<?php 
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php');
require_once(__DIR__ . '/../php/action_search.php');

if (!isset($_GET['page'])) {
    header('Location: not_found.php');
}

$page = $_GET['page'];

if (isset($_GET['q'])) {
    $query = $_GET['q'];
    if (isset($_GET['filtered'])) {
        $items = filteredResult($db, $_GET);
        $pageCount = count($items) > 0 ? 1 : 0;
    } else {
        $items = searchItems($db, $query, $page);
        $pageCount = pageCount($db, $query);
    }
} else {
    $items = null;
    $pageCount = 1;
}   

$stmt = $db->prepare("SELECT * FROM Categories;");
$stmt->execute();
$categories = $stmt->fetchAll();

?>
<!DOCTYPE html>
<head>
    <Title>Hand2Hand - Search Results</Title>
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="stylesheet" href="../css/search-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

</head>
<body>
    <?php drawNavbar($db); ?>
    <main>
        <form class="searchbar-replace" action="search.php" method="get">
            <input type="text" name="q" value="<?=$query?>" placeholder="Search...">
            <button type="submit"><i class="bi bi-search"></i></button>
            <input type="hidden" name="page" value="1">
        </form>
        <form class="apply-filters" action="search.php" method="get">
            <input type="hidden" name="q" value="<?=$query?>">
            <input type="hidden" name="page" value="1">
            <div class="search-filters">
                <h3>Categories</h3>
                <select class="filter-input" id="category" name="category">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?=htmlspecialchars($category['category_id'])?>"><?=htmlspecialchars($category['name'])?></option>
                    <?php } ?>
                </select>
                <h3>Maximum Price</h3>
                <input class="filter-input" type="number" name="price">
                <h3>Condition</h3>
                <select class="filter-input" id="condition" name="condition">
                    <option value="Brand New">Brand New</option>
                    <option value="Like New">Like New</option>
                    <option value="Good">Good</option>
                    <option value="Fair">Fair</option>
                    <option value="Poor">Poor</option>
                </select>
                <div id="attributes">
                </div>
                <button type="submit">Apply Filters</i></button>
                <input type="hidden" name="filtered" value="1">
            </div>
        </form>
        <?php if ($page >= 1 and $page <= $pageCount and $pageCount !== 1) {?>
        <div class="buttons-wrapper">
            <form class="prev-page" action="search.php" method="get">
                <input type="hidden" name="q" value="<?=$query?>">
                <input type="hidden" name="page" value="<?=$page - 1?>">

                <button id="prev-button" class="page-button" type="submit">◀</button>
            </form>
            <div class="current-page">
                <p><?=$page?></p>
            </div>
            <form class="next-page" action="search.php" method="get">
                <input type="hidden" name="q" value="<?=$query?>">
                <input type="hidden" name="page" value="<?=$page + 1?>">
                <button id="next-button" class="page-button" type="submit">▶</button>
            </form>
        </div>
        <?php } ?>
        <script>
                var pageNumber = <?=$page?>;
                var totalPages = <?=$pageCount?>;
        </script>
        <script src="../script/search.js"></script>
        <div class="wrapper search-results">
        <?php if ($pageCount == 0) { ?>
            <h1>No matching items were found</h1>
        <?php } else if ($page < 1 or $page > $pageCount) {
            header('Location: not_found.php');
         } else {
            foreach ($items as $item) {
            $image = fetchFirstImage($db, $item['item_id']);
        ?>
            <article class ="item" id="<?php echo htmlspecialchars($item['item_id'])?>">
                <div class="image-wrapper">
                    <img class="ad-image" src=<?php echo htmlspecialchars($image) ?>>
                </div>
                    <div class="ad-content">
                    <div class="content-left">
                        <h3 class="ad-title"><a href="item.php?id=<?php echo htmlspecialchars($item['item_id']) ?>"><?php echo htmlspecialchars($item['title']) ?></a></h3>
                        <div class="bottom-line">
                            <i class="bi bi-calendar"></i>
                            <span class="details"><?php echo date('jS M Y',strtotime(htmlspecialchars($item['publish_date']))) ?> • <?php echo htmlspecialchars($item['location'])?></span>
                        </div>
                    </div>
                    <div class="content-right">
                        <p class="price"><?php echo formatPrice(htmlspecialchars($item['price']),htmlspecialchars($item['currency']))?></p>
                    </div>
                </div>
            </article>
            <?php } 
        } ?>
        
        </div>
    </main>
</body>