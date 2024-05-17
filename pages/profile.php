<?php
    session_start();
    $db = new PDO("sqlite:../database.db");
    require_once(__DIR__ . '/../php/data_fetch.php'); 
    require_once(__DIR__ . '/../php/navbar.tpl.php'); 
    if (!isset($_GET['user'])) {
        header('Location: not_found.php');
    }
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
    <?php drawNavbar($db) ?>
    <main>
        <?php if (isset($_SESSION['user_id']) and ($_SESSION['user_id'] == $_GET['user'])) { ?>
            <div class="profile-left">
                <div class="pfp-wrapper">
                    <img src="<?=htmlspecialchars(fetchPFP($db, $_SESSION['user_id']))?>">
                    <a class="edit" href="edit.php"><i class="bi bi-pencil-square"></i></a>
                </div>
                <h1><?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                <p><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <a href="../php/logout.php">Logout</a>
            </div>
        <div class="profile-center">

        </div>
        <div class="profile-right"></div>

        </div>
            <?php 
        } else { $user = fetchSeller($db, $_GET['user'])?>
        <div class="profile-left">
            <div class="pfp-wrapper">
                <img src="<?=htmlspecialchars(fetchPFP($db, $user['user_id']))?>">
            </div>
            <h1><?php echo htmlspecialchars($user['username']); ?></h1>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        <div class="profile-center">

        </div>
        <div class="profile-right">
            
        </div>
        <?php } ?>
    </main>
</body>