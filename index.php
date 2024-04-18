<?php
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT * FROM Items ORDER BY RANDOM() LIMIT 4");
    $stmt->execute();
    $items1 = $stmt->fetchAll();
    $stmt = $db->prepare("SELECT * FROM Items ORDER BY RANDOM() LIMIT 4");
    $stmt->execute();
    $items2 = $stmt->fetchAll();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand</title>
    <link rel="stylesheet" href="css/style.css">
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
        <h1> FEATURED ITEMS </h1>
        <div class="featured">
            <?php
            foreach ($items1 as $item) {
                echo "<article>
                <div class='imgbox'>
                    <img src='" . $item['image_url'] . "'>
                </div>
                <a class='title' href='item.html'>" . $item['title'] . "</a>
                <p class ='small-text'>" . $item['location'] . "</p>
                <p class ='small-text'>Published " . $item['publish_date'] . "</p>
            </article>";
            }

            foreach ($items2 as $item) {
                echo "<article>
                <div class='imgbox'>
                    <img src='" . $item['image_url'] . "'>
                </div>
                <a class='title' href='item.html'>" . $item['title'] . "</a>
                <p class ='small-text'>" . $item['location'] . "</p>
                <p class ='small-text'>Published " . $item['publish_date'] . "</p>
            </article>";
            }
            ?>
            </div>
        </div>
    </main>
</body>