<?php 
session_start();
require_once(__DIR__ . '/../php/navbar.tpl.php'); 
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hand2Hand - Sign Up</title>
    <link rel="stylesheet" href="../css/auth-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($_SESSION) ?>
    <main>
        <div class = "content-box">
            <h1>Sign Up</h1>
            <form class ="auth-form" action="../php/action_signup.php" method="post">
                <div class="username">
                    <p>Username</p>
                    <input class ="auth-input" name="username" type="text" placeholder="Your Name" required>
                </div>
                <div class="email">
                    <p>E-Mail</p>
                    <input class ="auth-input" name="email" type="email" placeholder="YourName@example.com" required>
                </div>
                <div class="password">
                    <p>Password</p>
                    <input class ="auth-input" name="password" type="password" placeholder="Password" required>
                </div>
                <div class="confirm-password">
                    <p>Confirm Password</p>
                    <input class ="auth-input" name="confirm_password" type="password" placeholder="Confirm Password" required>
                </div>
                <div class="submit-box">
                    <button type="submit">Sign Up</button>
                </div>
            </form>
            <div class="alternative">
                <p>Already have an account? <a href="login.html">Log in.</a></p>
            </div>
        </div>
    </main>
    <script src="../script/errors.js"></script>
</body>
</html>
