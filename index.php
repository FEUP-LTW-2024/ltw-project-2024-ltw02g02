<?php
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT * FROM Items ORDER BY RANDOM() LIMIT 1");
    $stmt->execute();
    $item = $stmt->fetch();
    $stmt = $db->prepare("SELECT * FROM Users WHERE :seller_id = user_id");
    $stmt->bindParam(':seller_id',$item['seller_id']);
    $stmt->execute();
    $user = $stmt->fetch();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>OLX do OLX.</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="images/menu.png" href="bota.html">
            <i><a href="index.php">LFVT</a></i>
        </div>
        <form class="searchbar" action="/search" method="get">
            <input type="submit" value="">
            <input type="text" name="q" placeholder="Search...">
        </form>          
        <div class="navbar-right">
            <i><a href="login.php">Log In</a></i>
            <i><a href="signup.php">Sign Up</a></i>
        </div>
    </nav>
    <main>
        <h1> FEATURED ITEM </h1>
        <div class="featured">
            <?php
                echo "<div class='imgbox'>";
                echo "<img src=" . $item['image_url'] . ">";
                echo "</div>";
                echo "<div class='textbox'>";
                echo "<h1 class='title'>" . $item['title'] . "</h1>";
                echo "<p class='published'> Published " . date('d-m-Y H:i:s',strtotime($item['publish_date'])) . "</p>";
                echo "<p class='description'>" . $item['description'] . "</p>";
                echo "<p class='location'>" . $item['location'] . "</p>";
            ?>
            <div class="usercontainer">
                <?php
                    echo "<img class='pfp' src=" . $user['pfp_url'] . ">";
                    echo "<p class='username'>" . $user['username'] . "</p>";
                    echo "</div>";
                ?>
            </div>
        </div>
    </main>
</body>