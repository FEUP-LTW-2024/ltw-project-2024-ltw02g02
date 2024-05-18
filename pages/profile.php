<?php
    session_start();
    $db = new PDO("sqlite:../database.db");
    require_once(__DIR__ . '/../php/data_fetch.php'); 
    require_once(__DIR__ . '/../php/navbar.tpl.php'); 
    if (!isset($_GET['user'])) {
        header('Location: not_found.php');
    }
    $listings = fetchListings($db, $_GET['user']);
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
        <div class="profile-wrapper">
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
            <div class="profile-right">
                <?php if (count($listings) > 0) { ?>
                <h2>Your Listings</h2>
                <div class="listings">
                    <?php foreach ($listings as $listing) { ?>
                        <article class="listing">
                            <img src="<?=htmlspecialchars(fetchFirstImage($db, $listing['item_id']))?>">
                            <div class="listing-text">
                                <a href="item.php?id=<?=htmlspecialchars($listing['item_id'])?>"><?=htmlspecialchars($listing['title'])?></a>
                                <p><?=date('jS M Y',htmlspecialchars(strtotime($listing['publish_date'])))?></p>
                            </div> 
                            <form id="editForm" action="../pages/edit_listing.php" method="post">
                                <input type="hidden" name="item_id" value="<?=htmlspecialchars($listing['item_id'])?>">
                                <button type="submit"><i class="bi bi-pencil-square"></i></button>
                            </form>
                            <form id="deleteForm" action="../php/action_delete_item.php" method="post" onsubmit="return confirmDeletion(event);">
                                <input type="hidden" name="item_id" value="<?=htmlspecialchars($listing['item_id'])?>">
                                <button type="submit"><i class="bi bi-trash"></i></button>
                            </form>
                        </article>
                    <?php } ?>
                    <script src="../script/delete.js"></script>
                </div>
                <?php } else { ?>
                    <h2>You have no public listings up</h2>
                <?php } ?>
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
            <div class="profile-right">
            <?php if (count($listings) > 0) { ?>
                <h2>Public Listings</h2>
                <div class="listings">
                    <?php foreach ($listings as $listing) { ?>
                        <article class="listing">
                            <img src="<?=htmlspecialchars(fetchFirstImage($db, $listing['item_id']))?>">
                            <div class="listing-text">
                                <a href="item.php?id=<?=htmlspecialchars($listing['item_id'])?>"><?=htmlspecialchars($listing['title'])?></a>
                                <p><?=date('jS M Y',htmlspecialchars(strtotime($listing['publish_date'])))?></p>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <?php } else { ?>
                    <h2>No public listings available</h2>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </main>
    <script src="../script/errors.js"></script>
</body>