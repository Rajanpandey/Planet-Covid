<?php
include('header.php');
require('connect.php');
require('viewsCounter.php');

updateViewCount('home');

$ip = getIpAddress();
$today = new DateTime();

$query = "SELECT * FROM cases ORDER BY date";
$result = mysqli_query($conn, $query);

$activeCases = 0;
$totalCases = 0;
$casesArr = array();
while($row = mysqli_fetch_assoc($result)) {
    $daysPassed = $today->diff(new DateTime($row['date']))->format('%a');
    if($daysPassed < 14) {
        $activeCases += $row['count'];
    }
    $totalCases += $row['count'];
    $casesArr[] = $row;
}

if(isset($_POST['submitSurvey'])) {
    $answer = mysqli_real_escape_string($conn, trim($_POST['holi']));

    $query = "INSERT INTO holisurvey (answer, ip) VALUES ('$answer', '$ip')";
    if (mysqli_query($conn, $query)) {
        echo "<script type=\"text/javascript\"> alert('Thank you for the participating in the survery!'); location.href = 'index.php'; </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['saveFeedback'])) {
    $feedback = mysqli_real_escape_string($conn, trim($_POST['feedback']));
    $query = "INSERT INTO feedback (feedback) VALUES ('$feedback')";
    if(mysqli_query($conn, $query)) {
        echo "<script type=\"text/javascript\"> alert('Thank you for the feedback!'); location.href = 'index.php'; </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Planet Covid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/footer.css" rel="stylesheet">
    <link href="css/buttonIcons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    <div class="col-4 pb-4"><center><a href="map.php" class="btn btn-danger btn-lg btn-block">Planet - Covid Map</a></center></div>
                    <div class="col-4"><center><a href="vaccine.php" class="btn btn-warning btn-lg btn-block">Pune - Vaccine Status</a></center></div>
                    <div class="col-4 pb-4"><center><a href="puneLockdown.php" class="btn btn-success btn-lg btn-block">Info - Lockdown Update</a></center></div>
                    <div class="col-4"><center><a href="planet.php" class="btn btn-danger btn-lg btn-block">Planet - Covid Spread</a></center></div>
                    <div class="col-4 pb-4"><center><a href="pune.php" class="btn btn-warning btn-lg btn-block">Pune - Covid Spread</a></center></div>
                    <div class="col-4"><center><a href="protectYourself.php" class="btn btn-success btn-lg btn-block">Info - Protect Yourself</a></center></div>
                </div>
            </div>
            <div class="col-4">
                <h5>Your feedback and suggestions are valuable:</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <textarea class="form-control ml-3 mb-3" rows="2" name="feedback" required></textarea>
                        <button type="submit" name="saveFeedback" class="btn btn-primary ml-3"><i class="fas fa-comment-alt"></i>&nbsp; Submit Feedback Anonymously</button>
                    </div>
                </form>
            </div>
            <div class="col-12 table-responsive">
                <br/>
                <center><h4>Active Cases in Planet Millennium: <span class="text-danger"><?php echo $activeCases ?></span>/<?php echo $totalCases ?></h4>
                <p><b class="text-danger">Note:</b> These are the reported cases that we know. As most of the cases are asymptomatic, there can be x6-x10 more cases.</p></center>
                <h4>All Reported Cases:</h4>
                <table class="table table-bordered table-hover mt-4" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Flat/RH</th>
                            <th>Cases Count</th>
                            <th>Date</th>
                            <th>Days Passed</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for ($i=count($casesArr)-1; $i>=0; $i=$i-1) {
                            $daysPassed = $today->diff(new DateTime($casesArr[$i]['date']))->format('%a');
                    ?>
                            <tr class="<?php echo ($daysPassed >= 14) ? 'table-success' : 'table-danger' ?>">
                                <td><?php echo count($casesArr) - $i ?></td>
                                <td><?php echo $casesArr[$i]['loc']; ?></td>
                                <td><?php echo $casesArr[$i]['count']; ?></td>
                                <td><?php echo date_format(date_create($casesArr[$i]['date']),"d M, Y"); ?></td>
                                <td><?php echo $daysPassed; ?></td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>
</html>
