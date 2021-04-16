<?php
    $pages = [
        'plasma.php',
        'map.php',
        'planet.php',
        'pune.php',
        'vaccine.php',
        'puneLockdown.php',
        'protectYourself.php',
        'feedback.php'
    ];
?>

<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php echo in_array(end(explode("/", $_SERVER['REQUEST_URI'])), $pages) ? '' : 'active'?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'plasma.php') ? 'active' : ''?>" href="plasma.php">Plasma</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'map.php') ? 'active' : ''?>" href="map.php">Society Map</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'planet.php') ? 'active' : ''?>" href="planet.php">Covid in Planet</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'pune.php') ? 'active' : ''?>" href="pune.php">Covid in Pune</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'vaccine.php') ? 'active' : ''?>" href="vaccine.php">Pune Vaccination</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'puneLockdown.php') ? 'active' : ''?>" href="puneLockdown.php">Break the Chain</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'protectYourself.php') ? 'active' : ''?>" href="protectYourself.php">Protect Yourself</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'feedback.php') ? 'active' : ''?>" href="feedback.php">Feedback</a>
        </li>
</nav>

<style type="text/css">
    .active {
        background-color: green !important;
    }
</style>
