<?php 
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php');
?>
<!DOCTYPE html>
<head>
    <Title>Hand2Hand - Wishlist</Title>
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="stylesheet" href="../css/wishlist-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

</head>
<body>
    <?php drawNavbar($db) ?>
    <main>
        <div class="wishlist-wrapper">
        <?php if (isset($_SESSION['user_id'])) { 
            $user_id = $_SESSION['user_id'];
            $wishlist = fetchWishlist($db, $user_id);
            $count = count($wishlist);
            if ($count > 0) {
            foreach ($wishlist as $item) {
                $image = fetchFirstImage($db, $item['item_id']);
            ?>
            <article class ="wishlist-item" id="<?php echo $item['item_id']?>">
                <div class="image-wrapper">
                    <img  class="ad-image" src=<?php echo $image ?>>
                </div>
                <div class="text-wrapper">
                    <h3 class="ad-title"><a href="item.php?id=<?php echo $item['item_id'] ?>"><?php echo $item['title'] ?></a></h3>
                    <div class="bottom-line">
                        <i class="bi bi-calendar"></i>
                        <span class="details"><?php echo date('jS M Y',strtotime($item['publish_date'])) ?> • <?php echo $item['location']?></span>
                    </div>
                </div>
                <div class="article-right">
                    <p class="price"><?php formatPrice($item['price'],$item['currency'])?></p>
                    <a onclick="removeFromWishlist(<?=$_SESSION['user_id']?>,<?=$item['item_id']?>)"><i class="bi bi-trash"></i></a>
                </div>
            </article>
            <?php }} else { ?>
                <h1>You haven't added any items to your wishlist yet!</h1>
            <?php }
        } else { ?>
                <h1>Not logged in, please <a href="login.php">log in</a> or <a href="signup.php">create an account</a> to view your wishlist!</h1>
            <?php } ?>
            <script src="../script/wishlist.js"></script>
        </div>
    </main>
</body>