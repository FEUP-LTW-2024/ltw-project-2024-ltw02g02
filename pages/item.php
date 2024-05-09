<?php
    session_start();
    $db = new PDO("sqlite:../database.db");
    require_once(__DIR__ . '/../php/navbar.tpl.php');
    $stmt = $db->prepare("SELECT * FROM Items WHERE item_id = :id");
    $stmt->bindParam(":id",$_GET['id']);
    $stmt->execute();
    $item = $stmt->fetch();
    $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
    $stmt->bindParam(":id", $item["seller_id"]);
    $stmt->execute();
    $user = $stmt->fetch();
    $images = explode(',',$item['image_url']);
    $timestamp = strtotime($item['publish_date']);
    $currency = '€'
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?php echo $item['title']; ?></title>
    <link rel="stylesheet" href="../css/item-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
<?php drawNavbar($_SESSION) ?>
    <main>
        <div id=container1>
            <div id="img-slider">
                <?php 
                foreach ($images as $image) {
                    echo "<div class ='img-container'>
                            <img  class='background' src='" . $image . "'>
                            <img class='slide' src=" . $image . ">
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
                    <h1 class="title"><?php echo $item['title']; ?></h1>

                    <?php if (isset($_SESSION['username'])):
                        $user_id = $_SESSION['user_id'];
                        $item_id = $_GET['id'];
                        $stmt = $db->prepare('SELECT * FROM Wishlist WHERE user_id = :user_id AND item_id = :item_id');
                        $stmt->bindParam(':user_id', $user_id);
                        $stmt->bindParam(':item_id', $item_id);
                        $stmt->execute();
                        $count = count($stmt->fetchAll());
                    ?>
                    <a onclick="wishlistAction(<?=$_SESSION['user_id']?>,<?=$item['item_id']?>)">
                    <?php if ($count > 0) { ?>
                        <i id="heart" class="bi bi-heart-fill"></i>
                    <?php } else { ?>
                        <i id="heart" class="bi bi-heart"></i>
                    <?php } endif; ?>
                    </a>
                    <script src="../script/wishlist.js"></script>

                </div>
                <h2><?php echo $currency . number_format($item['price'],2,".",","); ?></h2>
                <p class="small-text">Listed on the <?php echo date('jS M Y',$timestamp); ?></p>
            </div>
            <div id="description-box"> 
                <h2>Seller's description</h2>
                <div id="description-scroll">
                        <p class="description"><?php echo $item['description']; ?></p>
                </div>
                <p class="location"><?php echo $item['location']; ?></p>
            </div>
            <div id="seller">
                <h2>Seller Information</h2>
                <div class="user-box">
                    <img id="profile-picture" src="<?php echo $user['pfp_url']; ?>">
                    <a id="seller-name" href="user.html"><?php echo $user['username']; ?></p>
                </div>
                <p class="small-text">Joined 2001</p>
            </div>
        </div>
    </main>
</body>