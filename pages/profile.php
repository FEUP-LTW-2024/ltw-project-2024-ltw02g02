<?php
    session_start();
    require_once(__DIR__ . '/../php/navbar.tpl.php'); 
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Hand2Hand - Profile</title>
    <link rel="stylesheet" href="../css/profile-style.css">
    <link rel="stylesheet" href="../css/navbar-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
</head>
<body>
    <?php drawNavbar($_SESSION) ?>
    <main>
        <div class="profile-left">
            <img id="pfp" src="<?php echo htmlspecialchars($_SESSION['pfp_url']); ?>">
            <h1><?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <p><?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <a href="../php/logout.php">Logout</a>
        </div>
        <div class="profile-center">

        </div>
        <div class="profile-right">
            
        </div>
    </main>
</body>