<?php
    session_start();
    $db = new PDO("sqlite:../database.db");
    require_once(__DIR__ . '/../php/navbar.tpl.php');
    require_once(__DIR__ . '/../php/data_fetch.php');
    if (!isset($_GET['id'])) {
        header('Location: not_found.php');
    }
    $item = fetchItem($db, $_GET['id']);
    if (!$item) {
        header('Location: not_found.php');
    }
    $seller = fetchSeller($db, $item['seller_id']);
    $images = fetchAllImages($db, $item['item_id']);
    $timestamp = strtotime($item['publish_date']);
    $formattedPrice = formatPrice($item['price'],$item['currency']);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($item['title']); ?></title>
    <link rel="stylesheet" href="../css/item-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<?php drawNavbar($db) ?>
    <main>
        <div id=container1>
            <div id="img-slider">
                <?php 
                foreach ($images as $image) {
                    echo "<div class ='img-container'>
                            <img  class='background' src='" . htmlspecialchars($image['image_url']) . "'>
                            <img class='slide' src=" . htmlspecialchars($image['image_url']) . ">
                        </div>";
                };
                ?>
                <a class="prev-button" onclick="moveSlides(-1)">&#10094;</a>
                <a class="next-button" onclick="moveSlides(1)">&#10095;</a>
            </div>
            <script src="../script/slider.js"></script>
        </div>
        <div id="container2">
            <div id="ad-header">
                <div class="title-box">
                    <h1 class="title"><?php echo htmlspecialchars($item['title']); ?></h1>

                    <?php if (isset($_SESSION['username'])):
                        $check = wishlistCheck($db, $_SESSION['user_id'], $item['item_id']);
                    ?>
                    <a onclick="wishlistAction(<?=$_SESSION['user_id']?>,<?=$item['item_id']?>)">
                    <?php if ($check) { ?>
                        <i id="heart" class="bi bi-heart-fill"></i>
                    <?php } else { ?>
                        <i id="heart" class="bi bi-heart"></i>
                    <?php } endif; ?>
                    </a>
                    <script src="../script/wishlist.js"></script>

                </div>
                <h2><?php echo htmlspecialchars($formattedPrice); ?></h2>
                <p class="small-text">Listed on the <?php echo date('jS M Y',htmlspecialchars($timestamp)); ?></p>
            </div>
            <div id="description-box"> 
                <h2>Seller's description</h2>
                <div id="description-scroll">
                        <p class="description"><?php echo htmlspecialchars($item['description']); ?></p>
                </div>
                <p class="location"><?php echo htmlspecialchars($item['location']); ?></p>
            </div>
            <div id="seller">
                <h2>Seller Information</h2>
                <div class="user-box">
                    <img id="profile-picture" src="<?php echo htmlspecialchars(fetchPFP($db, $seller['user_id'])); ?>">
                    <a id="seller-name" href="profile.php?user=<?=htmlspecialchars($seller['user_id'])?>"><?php echo htmlspecialchars($seller['username']); ?></a></p>
                </div>
                <p class="small-text">Joined <?php echo date('Y',strtotime(htmlspecialchars($seller['join_date']))) ?></p>
            </div>
        </div>
    </main>
</body>