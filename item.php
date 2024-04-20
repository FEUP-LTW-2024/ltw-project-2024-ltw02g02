<?php
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT * FROM Items WHERE item_id = :id");
    $stmt->bindParam(":id",$_GET['item_id']);
    $stmt->execute();
    $item = $stmt->fetch();
    $stmt = $db->prepare("SELECT * FROM Users WHERE user_id = :id");
    $stmt->bindParam(":id", $item["seller_id"]);
    $stmt->execute();
    $user = $stmt->fetch();
    $images = explode(',',$item['image_url']);
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Item Test</title>
    <link rel="stylesheet" href="css/item-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <div class="navbar-left">
                <div class="menuicons">
                    <img id="menulist" src="icons/list.svg">
                    <img id="menuclosed" class="dissapear" src="icons/x.svg">
                 </div>
                <li><a class="logo" href="index.php">Hand2Hand</a></li> 
                <form class="searchbar" action="/search" method="get">
                    <input type="text" name="q" placeholder="Search...">
                    <i class="bi bi-search"></i>
                </form>
            </div>    
            <div class="navbar-right">
                <li><a href="login.php">Log In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </div>
        </div>
    </nav>
    <div id="menu" class="menu">Guilherme é Gay</div>
    <script src="script/script.js"></script>
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
            <script src="script/slider.js"></script>
        </div>
        <div id="container2">
            <div id="ad-header">
                <h1 class="title"><?php echo $item['title']; ?></h1>
                <h2><?php echo $item['price']; ?></h2>
                <p class="small-text">Listed on the <?php echo date('jS M Y',$item['title']); ?></p>
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