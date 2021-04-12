<?php
include('header.php');
require('viewsCounter.php');

updateViewCount('vaccine');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pune Vaccine Status</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row pb-3">
            <div class="col-12 pt-3 pb-3">
                <a href="index.php" class="btn btn-danger">Return back to Home</a>
            </div>
            <div class="col-12 pb-4">
                <h4><b class="text-danger">Daily Vaccine</b> Count in Pune:</h4>
                <div id="totalVaccine" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-12 col-xl-6 pb-4">
                <h4>Percentage of Punekars who got <b class="text-danger">1st dose only</b>:</h4>
                <div id="firstDose" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-12 col-xl-6 pb-4">
                <h4>Percentage of Punekars who got <b class="text-danger">both 1st and 2nd doses</b>:</h4>
                <div id="secondDose" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-12 col-xl-6">
                <h4><b class="text-danger">Different Vaccines</b> Administered in Pune:</h4>
                <div id="vaccine" style="width: 100%; height: 500px;"></div>
            </div>
            <div class="col-12 col-xl-6">
                <h4><b class="text-danger">Gender-wise</b> Vaccination Breakup in Pune:</h4>
                <div id="gender" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>

    <script src="js/vaccineData.js?version=4"></script>
    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>

</script>
</html>
