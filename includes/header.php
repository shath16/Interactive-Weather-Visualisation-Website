<?php
 
 //the code for this file will be present at the top of multiple pages = shared navigation bar//


  //loads session.php, so file can have login/admin admin function//
require_once __DIR__ . '/session.php';
$current = basename($_SERVER['PHP_SELF']);
function active_link(string $file, string $current): string {
    return ($file === $current) ? 'active-link' : '';
}
?>
<header class="header">
    <div class="inner-width">
        <div class="logo">
            <a href="index.php">Portfolio</a>
        </div>

        <nav class="navbar" id="navbar">
            <a href="index.php" class="<?php echo active_link('index.php', $current); ?>">Home</a>
            <a href="cv.php" class="<?php echo active_link('cv.php', $current); ?>">CV</a>
            <a href="weather.php" class="<?php echo active_link('weather.php', $current); ?>">Weather</a>
            <a href="addweather.php" class="<?php echo active_link('addweather.php', $current); ?>">Weather System</a>

            <?php if (is_admin()): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php" class="<?php echo active_link('login.php', $current); ?>">Login</a>
            <?php endif; ?>

        </nav>

        <!--hamburger menu-->
        <div id="menu-btn" class="hamburger">
            <span></span><span></span><span></span>
        </div>
    </div>
</header>
