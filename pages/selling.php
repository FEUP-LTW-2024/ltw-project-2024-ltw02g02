<?php
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php'); 
$stmt = $db->prepare('SELECT * FROM Categories;');
$stmt->execute();
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand - List Item</title>
    <link rel="stylesheet" href="../css/selling-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($db); ?>
    <main>
        <h1>Publish new listing</h1>
        <form class="add-listing" action="../php/action_list_item.php" method="post" enctype="multipart/form-data">
            <div class="add-title wrapper">
                <h2>Listing Title<span class="required">*</span></h2>
                <input class="title-text" type="text" name ="title" placeholder="Write your listing title here..." minlength="4" maxlength="70">
                <h3>Choose a fitting category</h3>
                <select id="category" name="category">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?=htmlspecialchars($category['category_id'])?>"><?=htmlspecialchars($category['name'])?></option>
                    <?php } ?>
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
                <h2>Description<span class="required">*</span></h2>
                <textarea class="big-text" id="description" name="description" maxlength="1000" minlength="20" placeholder="Write a fitting description for the item here..."required></textarea>
                <h3>Choose a fitting condition</h3>
                <select id="condition" name="condition">
                    <option value="Brand New">Brand New</option>
                    <option value="Like New">Like New</option>
                    <option value="Good">Good</option>
                    <option value="Fair">Fair</option>
                    <option value="Poor">Poor</option>
                </select>
            </div>
            <div class="add-details wrapper">
                <h2>Details</h2>
                <h3>Location<span class="required">*</span></h3>
                <input class="small-text" type="text" name="location" placeholder="ex .: Lisbon, Portugal ..." required>
                <div id="attributes">

                </div>
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="cellphone-checkbox">
                    <label for="cellphone-number">Associate Cellphone Number to listing?</label>
                </div>
                <div id="cellphone-wrapper" class="cellphone-wrapper">
                    <h3>Cellphone Number</h3>
                    <input class="small-text" type="text" id="cellphone-number" name="cellphone-number">
                </div>
            </div>
            <div class="submit wrapper">
                <div class="price-wrapper">
                    <h2>Listing Price<span class="required">*</span>:</h2>
                    <input class="small-text" type="number" id="price" name="price" step="0.01" required>
                    <select id="currency" name="currency">
                        <option value="EUR">€ (EUR)</option>
                        <option value="USD">$ (USD)</option>
                        <option value="AUD">AU$ (AUD)</option>
                        <option value="CAD">CA$ (CAD)</option>
                        <option value="GBP">£ (GBP)</option>
                        <option value="YEN">¥ (YEN)</option>
                        <option value="BRL">R$ (BRL)</option>
                    </select>
                </div>
                <input class="submit-button" type="submit" value="List Item">
            </div>
        </form>
        <p class="required-warning">Fields marked with <span class="required">*</span> are required.</p>
        <script src="../script/listing.js"></script>
        <script src="../script/errors.js"></script>
    </main>