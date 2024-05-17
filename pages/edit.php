<?php
session_start();
$db = new PDO("sqlite:../database.db");
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
require_once(__DIR__ . '/../php/data_fetch.php'); 
?>



<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand - Edit Profile</title>
    <link rel="stylesheet" href="../css/edit-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($db) ?>
    <main>
        <h1>Hello, <?=htmlspecialchars($_SESSION['username'])?>!</h1>
            <div class="form wrapper">
                <div class="pfp-wrapper">
                    <img src="<?=htmlspecialchars(fetchPFP($db, $_SESSION['user_id']))?>">
                    <a class="edit-pfp" onclick="openPFP()"><i class="bi bi-pencil-square"></i></a>
                </div>
                <div class="content-wrapper">
                    <form class ="auth-form" action="../php/action_edit.php" method="post">
                        <div class="username">
                            <h3>Change your Username</h3>
                            <input class ="edit-input" name="username" type="text" placeholder="Your Name">
                        </div>
                        <div class="email">
                            <h3>Change your E-Mail</h3>
                            <input class ="edit-input" name="email" type="email" placeholder="YourName@example.com">
                        </div>
                        <div class="password">
                            <h3>Change your Password</h3>
                            <input id="passwordEdit" class ="edit-input" name="password" type="password" placeholder="Password">
                        </div>
                        <div id="confirmPassword" class="confirm-password">
                            <h3>Confirm New Password</h3>
                            <input class ="edit-input" name="confirm_password" type="password" placeholder="Confirm Password">
                        </div>
                        <button class="submit-button" type="submit">Edit Profile</button>
                    </form>
                </div>
            </div>
            <div id="uploadPFP" class="upload-pfp">
                <form class="pfp-form" action="../php/action_edit.php" method="post" enctype="multipart/form-data">
                    <a class="close-pfp" onclick="closePFP()"><i class="bi bi-x"></i></a>
                    <input type="file" id="fileInput" name="new_pfp" accepts="image/*">
                    <button class="submit-button" type="submit">Submit Profile Picture</button>
                </form>
            </div>
        <script src="../script/edit.js"></script>
        <script src="../script/errors.js"></script>
    </main>