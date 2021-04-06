<nav class="navbar sticky-top navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?php echo !strpos($_SERVER['REQUEST_URI'], 'map.php') && !strpos($_SERVER['REQUEST_URI'], 'pune.php') && !strpos($_SERVER['REQUEST_URI'], 'feedback.php') && !strpos($_SERVER['REQUEST_URI'], 'planet.php') && !strpos($_SERVER['REQUEST_URI'], 'vaccine.php') && !strpos($_SERVER['REQUEST_URI'], 'puneLockdown.php') && !strpos($_SERVER['REQUEST_URI'], 'protectYourself.php') ? 'active' : ''?>" href="index.php">Home</a>
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
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], 'puneLockdown.php') ? 'active' : ''?>" href="puneLockdown.php">Lockdown</a>
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
