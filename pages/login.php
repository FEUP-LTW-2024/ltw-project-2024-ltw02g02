<?php 
session_start();
$db = new PDO('sqlite: ../database.db');
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
?>
<!DOCTYPE html>
<head>
    <Title>Hand2Hand - Log In</Title>
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="stylesheet" href="../css/auth-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

</head>
<body>
    <?php drawNavbar($db) ?>
    <main>
        <div class ="content-box">
        <h1>Log In</h1>
        <form class="auth-form" action="../php/action_login.php" method="post">
            <div class="email">
                <p>E-Mail</p>
                <input class ="auth-input" name="email" type="email" placeholder="YourEmail@example.com" required>
            </div>
            <div class="password">
                <p>Password</p>
                <input class ="auth-input" name="password" type="password" placeholder="Password" required>
            </div>
            <div class="submit-box">
                <button type="submit">Log In</button>
            </div>
        </form>
        <div class="alternative">
            <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
        </div>
    </div>
    </main>
    <script src="../script/errors.js"></script>
</body>