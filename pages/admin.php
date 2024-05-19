<?php
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php'); 
if ($_SESSION['is_admin'] !== 1) {
    header('Location: not_found.php');
}   
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand - Control Panel</title>
    <link rel="stylesheet" href="../css/admin-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($db); ?>
    <main>
        <h1>Admin Control Panel</h1>
        <form class="add-category" action="../php/action_add_category.php" method="post">
            <div class="wrapper">
                <h2>Add Category</h2>
                <h3>Category Name</h3>
                <input class="title-text" type="text" name ="name" placeholder="Write your category title here..." minlength="2" maxlength="16" required>
                <h3>Attributes</h3>
                <div id="attributes-wrapper" class="attributes-wrapper">
                </div>
                <button type="button" id="attribute-button" onclick="addAttribute()">+</button>
                <button type="submit">Add Category</button>
            </div>
        </form>
        <script src="../script/admin.js"></script>
        <script src="../script/errors.js"></script>
    </main>