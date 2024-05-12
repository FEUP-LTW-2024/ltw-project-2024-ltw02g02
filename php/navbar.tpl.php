<?php function drawNavbar($sessionData) { ?>
    <nav class="navbar">
        <div class="navbar-inner">
            <div class="navbar-left">
                <div class="menuicons">
                    <img id="menulist" src="../icons/list.svg">
                    <img id="menuclosed" class="dissapear" src="../icons/x.svg">
                 </div>
                <li><a class="logo" href="../index.php">Hand2Hand</a></li> 
                <form class="searchbar" action="/search" method="get">
                    <input type="text" name="q" placeholder="Search...">
                    <i class="bi bi-search"></i>
                </form>
            </div>    
            <div class="navbar-right">
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="../pages/profile.php"><img id="pfp" src="<?php echo htmlspecialchars($_SESSION['pfp_url']); ?>"> Profile</a></li>
                    <li><a href="../pages/wishlist.php">Wishlist</a></li>
                    <li><a href="../pages/selling.php">List Item</a></li>
                <?php else: ?>
                    <li><a href="../pages/login.php">Log In</a></li>
                    <li><a href="../pages/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div id="menu" class="menu">
        <div class="menu-items">
            <div class="menu-item">
                <a href="">View My Listings</a>
            </div>
            <div class="menu-item">
                <a href="">Mensagens</a>
            </div>
        </div>
        <div class="logout-wrapper">
            <a href="">Log Out</a>
        </div>
    </div>
    <script src="../script/menu.js"></script>
<?php } ?>