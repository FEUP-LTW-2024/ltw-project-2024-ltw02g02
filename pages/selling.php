<?php
session_start();
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php'); 
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Item Test</title>
    <link rel="stylesheet" href="../css/selling-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($_SESSION) ?>
    <main>
        <h1>Publish new listing</h1>
        <form class="add-listing" action="../php/action_list_item.php" method="post" enctype="multipart/form-data">
            <div class="add-title wrapper">
                <h2>Listing Title</h2>
                <input type="text" name ="title" minlength="16" maxlength="70">
                <h3>Choose a fitting category</h3>
                <select id="category" name="category">
                    <option value="vehicles">Vehicles</option>
                    <option value="clothing">Clothing</option>
                    <option value="technology">Technology</option>
                    <option value="sports">Sports</option>
                    <option value="literature">Literature</option>
                    <option value="home">Home</option>
                </select>
            </div>
            <div class="add-image wrapper">
                <h2>Images</h2>
                <p>The first image will be the listing's main image!</p>
                <label for="image">Choose an image:</label>
                <input type="file" id="fileInput" name="images[]" accepts="image/*" multiple>
                <output id="display-images">
            </div>
            <div class="add-description wrapper">
                <h2>Description</h2>
                <input type="text" name="description" maxlength="1000" minlength="20" required>
                <h3>Choose a fitting condition</h3>
                <select id="condition" name="condition">
                    <option value="brand-new">Brand New</option>
                    <option value="like-new">Like New</option>
                    <option value="good">Good</option>
                    <option value="fair">Fair</option>
                    <option value="poor">Poor</option>
                </select>
            </div>
            <div class="add-details wrapper">
                <h2>Details</h2>
                <h3>Location</h3>
                <input type="text" name="location" required>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="cellphone-checkbox">
                    <label for="cellphone-number">Associate Cellphone Number to listing?</label>
                </div>
                <div id="cellphone-wrapper" class="cellphone-wrapper">
                    <h3>Cellphone Number</h3>
                    <input type="text" id="cellphone-number" name="cellphone-number">
                </div>
            </div>
            <div class="submit wrapper">
                <input type="number" id="price" name="price" required>
                <input type="submit">
            </div>
        </form>
        <script src="../script/listing.js"></script>
        <script src="../script/errors.js"></script>
    </main>