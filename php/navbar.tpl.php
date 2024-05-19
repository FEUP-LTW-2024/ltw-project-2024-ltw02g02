<?php 
function drawNavbar(PDO $db) { ?>
    <nav class="navbar">
        <div class="navbar-inner">
            <div class="navbar-left">
                <div class="menuicons">
                    <img id="menulist" src="../icons/list.svg">
                    <img id="menuclosed" class="dissapear" src="../icons/x.svg">
                 </div>
                <li><a class="logo" href="../index.php">Hand2Hand</a></li> 
                <button class="search-display" onclick="displaySearchbar()"><i class="bi bi-search"></i></button>
            </div>    
            <div class="navbar-right">
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="../pages/profile.php?user=<?=htmlspecialchars($_SESSION['user_id'])?>"><img id="pfp" src="<?=htmlspecialchars(fetchPFP($db, $_SESSION['user_id']))?>"> Profile</a></li>
                    <li><a href="../pages/wishlist.php">Wishlist</a></li>
                    <li><a href="../pages/selling.php">List Item</a></li>
                <?php else: ?>
                    <li><a href="../pages/login.php">Log In</a></li>
                    <li><a href="../pages/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <form id="searchbar" class="searchbar" action="../pages/search.php" method="get">
        <input type="text" name="q" placeholder="Search...">
        <button type="submit"><i class="bi bi-search"></i></button>
        <input type="hidden" name="page" value="1">
    </form>
    <div id="menu" class="menu">
    <?php if (isset($_SESSION['username'])): ?>
        <div class="menu-items">
            <div class="menu-item">
                <a href="">View My Listings</a>
            </div>
            <div class="menu-item">
                <a href="../pages/messages.php">Messages</a>
            </div>
        </div>
        <div class="logout-wrapper">
        <a href="../php/logout.php">Log Out</a>
        </div>
        <?php endif; ?>
    </div>
    <script src="../script/menu.js"></script>
<?php } ?>