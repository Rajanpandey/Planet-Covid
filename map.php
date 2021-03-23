<?php
include('header.php');
require('connect.php');
require('viewsCounter.php');

updateViewCount('map');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Live Active Cases Map</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/map.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <a href="index.php" class="btn btn-danger mt-3">Return back to Home</a>
            <h4 class="pt-3">Live Active Cases Map:</h4>
            <div id="zone-image-container">
                <img src="img/map.png" id="map"/>
            </div>
            </div>
        </div>
    </div>

    <script src="js/drawZonesOnMap.js"></script>
    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>
</html>
