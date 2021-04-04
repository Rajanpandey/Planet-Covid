<?php
include('header.php');
require('viewsCounter.php');

updateViewCount('puneLockdown');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pune Lockdown</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <br/>
                <a href="index.php" class="btn btn-danger">Return back to Home</a>
                <h3 class="mt-3">Pune Semi-Lockdown is applicable from 3rd April (Saturday) till 9th April (Friday):</h3>
                <div class="row">
                    <div class="col-12 col-xl-6">
                        <h3 class="mt-3">Restrictions:</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><b>6pm to 6am travel restrictions</b> for all vehicles including cabs, taxis and autorickshaws.</li>
                            <li class="list-group-item"><b>Barring medical and essential services</b>, all shops must close as per the 6pm deadline.</li>
                            <li class="list-group-item"><b>Complete ban</b> on social, political, and religious meetings.</li>
                        </ul>
                    </div>
                    <div class="col-12 col-xl-6">
                        <h3 class="mt-3">No groups during the day too:</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Ban on assembly of <b>more than 5 persons at one place from 6am to 6pm</b>.</li>
                            <li class="list-group-item"><b>Rs 1,000 fine</b> for each person for violation.</li>
                            <li class="list-group-item">Prosecution under Section 188 (disobedience of order) of the IPC.</li>
                        </ul>
                    </div>
                    <div class="col-12 col-xl-6">
                        <h3 class="mt-5">Shutters Down</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Restaurants (dine-in), bars, food courts, malls, cinemas, theatres, swimming pools, spas, gyms, sports complexes, and clubs to remain shut <b>till further orders</b>.</li>
                            <li class="list-group-item">Schools and colleges shut till <b>April 30</b>, all coaching classes, excluding MPSC, UPSC study centres with 50% capacity, to remain shut.</li>
                        </ul>
                    </div>
                    <div class="col-12 col-xl-6">
                        <h3 class="mt-5">Carry Documents</h3>
                        <ul class="list-group">
                            <li class="list-group-item"><b>Office-goers</b> must carry I-cards & letters by their employers specifying duty hours.</li>
                            <li class="list-group-item">Travel to and from <b>airport</b> by showing flight tickers or boarding pass.</li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <h3 class="mt-5">What is permitted?</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Milk, vegetable, fruit supply, newspaper distribution, establishments providing essential services and their staff, people going for vaccination and their vehicles, and vehicles transporting employees for industrial work are <b>exempted from night travel restrictions</b>.</li>
                            <li class="list-group-item">PMPML buses only for emergency services.</li>
                            <li class="list-group-item"><b>Online food delivery till 11pm</b>.</li>
                            <li class="list-group-item">Marriages allowed with 50 people.</li>
                            <li class="list-group-item">Only 20 people for last rites.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>
</html>
