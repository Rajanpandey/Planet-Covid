<?php
include('header.php');
require('connect.php');
require('viewsCounter.php');

updateViewCount('planet');

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pune Covid Status</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <br/>
            <div class="col-12 pt-3 pb-3">
                <a href="index.php" class="btn btn-danger">Return back to Home</a>
            </div>
            <div class="col-12 col-xl-6">
                <h4>Daily <b class="text-danger">New Confirmed Cases</b> Count in Planet M:</h4>
                <div id="dailyNewConfirmPlanet" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-12 col-xl-6">
                <h4>Day-wise <b class="text-danger">Active Cases</b> in Planet M:</h4>
                <div id="totalActivePlanet" style="width: 100%; height: 500px;"></div>
            </div>
            <br/>
            <hr/>
            <div class="col-12">
                <h4>Total <b class="text-danger">Cumulative Confirmed Cases</b> in Planet M:</h4>
                <div id="totalConfirmPlanet" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>

    <script src="js/planetMAmCharts.js"></script>
    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>

</script>
</html>
