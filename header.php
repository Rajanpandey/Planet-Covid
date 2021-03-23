<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo !strpos($_SERVER['REQUEST_URI'], 'map.php') && !strpos($_SERVER['REQUEST_URI'], 'feedback.php') && !strpos($_SERVER['REQUEST_URI'], 'protectYourself.php') ? 'active' : ''?>" href="index.php">   Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'map.php') ? 'active' : ''?>" href="map.php">   Map</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'protectYourself.php') ? 'active' : ''?>" href="protectYourself.php">   Protect Yourself</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'feedback.php') ? 'active' : ''?>" href="feedback.php">   Feedback</a>
        </li>
    </ul>
</nav>
