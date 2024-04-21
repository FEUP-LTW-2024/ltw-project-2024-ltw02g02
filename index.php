<?php
    session_start();
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
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="profile.php"><img id="pfp" src="<?php echo htmlspecialchars($_SESSION['pfp_url']); ?>"> Profile</a></li>
                    <li><a href="wishlist.html">Wishlist</a></li>
                <?php else: ?>
                    <li><a href="login.html">Log In</a></li>
                    <li><a href="signup.html">Sign Up</a></li>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div id="menu" class="menu">Guilherme é Gay</div>
    <script src="script/script.js"></script>
    <main>
        <h1> FEATURED ITEMS </h1>
        <div class="featured">
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            <article>
                <div class="imgbox">
                    <img src="images/ps2.webp">
                </div>
                <a class="title" href="item.html">Title Text Example</a>
                <p class ="small-text">Praia da Vitória</p>
                <p class ="small-text">Published 01-01-2000 00:00</p>
            </article>
            </div>
        </div>
    </nav>
    <div id="menu" class="menu">Guilherme é Gay</div>
    <script src="script/script.js"></script>
    <main>
        <h1> FEATURED ITEMS </h1>
        <div class="featured">
            <?php
            foreach ($items as $item) {
                $images = explode(",", $item["image_url"]);
                $image = $images[0];
                echo "<article>
                <div class='imgbox'>
                    <img src='" . $image . "'>
                </div>
                <a class='title' href='item.php?id=" . $item['item_id'] . "'>" . $item['title'] . "</a>
                <p class ='small-text'>" . $item['location'] . "</p>
                <p class ='small-text'>Published " . $item['publish_date'] . "</p>
            </article>";
            }
            ?>
        </div>
    </main>
</body>