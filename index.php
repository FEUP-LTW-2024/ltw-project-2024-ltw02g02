<?php
    $db = new PDO("sqlite:database.db");
    $stmt = $db->prepare("SELECT * FROM Items ORDER BY RANDOM() LIMIT 1");
    $stmt->execute();
    $item = $stmt->fetch();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>OLX do OLX.</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="images/menu.png" href="bota.html">
            <i>LFVT</i>
        </div>
        <form class="searchbar" action="/search" method="get">
            <input type="submit" value="">
            <input type="text" name="q" placeholder="Search...">
        </form>          
        <div class="navbar-right">
            <i>Log In</i>
            <i>Sign Up</i>
        </div>
    </nav>
    <main>
        <?php
            echo "<h1>" . $item['title'] . "</h1>";
            echo "<img src=" . $item['image_url'] . ">";
            echo "<p>" . $item['description'] . "</p>";
        ?>
    </main>
</body>