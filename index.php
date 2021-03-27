<?php
include('header.php');
require('connect.php');
require('viewsCounter.php');

updateViewCount('home');

$ip = getIpAddress();
$today = new DateTime();

$query = "SELECT * FROM cases";
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

$holiSurveyArr = array();
$holiSurvey = mysqli_query($conn, "SELECT * FROM holisurvey");
while($row = mysqli_fetch_assoc($holiSurvey)) {
    $holiSurveyArr[] = $row;
}

$surveryAnswered = false;
$option1 = 0;
$option2 = 0;
$option3 = 0;
for ($i=0; $i<count($holiSurveyArr); $i=$i+1) {
    if ($holiSurveyArr[$i]['ip'] == $ip) {
        $surveryAnswered = true;
    }

    if ($holiSurveyArr[$i]['answer'] == 'option1') {
        $option1 = $option1 + 1;
    }

    if ($holiSurveyArr[$i]['answer'] == 'option2') {
        $option2 = $option2 + 1;
    }

    if ($holiSurveyArr[$i]['answer'] == 'option3') {
        $option3 = $option3 + 1;
    }
}
$totalResponses = $option1 + $option2 + $option3;
$option1Percent = round($option1 / $totalResponses * 100);
$option2Percent = round($option2 / $totalResponses * 100);
$option3Percent = round($option3 / $totalResponses * 100);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Planet Covid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/footer.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid pt-3">
        <div class="row">
            <!-- Holi Content Begins -->
            <div class="col-12 pb-3">
                <center><h2><span class="text-info">H</span><span class="text-warning">a</span><span class="text-danger">p</span><span class="text-success">p</span><span class="text-dark">y</span> <span class="text-danger">H</span><span class="text-primary">o</span><span class="text-success">l</span><span class="text-warning">i</span><span class="text-danger">!</span><span class="text-primary">!</span></h2>
                <h4>Holi is here! And so is second wave of corona in Pune!</h4></center>
            </div>
            <div class="d-flex bd-highlight">
                <div class="pb-4 p-2 flex-fill bd-highlight">
                    <h5>Holi 2021 Survey:</h5>
                    <div class="card card-cascade">
                        <div class="card-body card-body-cascade text-center">
                            <h4 class="card-title"><strong>Holi Survey (anonymous)</strong></h4>
                            <p class="font-weight-normal">Let others Planet members know what the majority of memebers are planning for Holi 2021</p>
                        </div>
                        <hr>
<?php
                        if ($surveryAnswered) {
?>
                            <div class="m-3">
                                <p>Not playing Holi. Just celebrating with wishes and sweets:</p>
                                <div class="progress mb-4">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo $option1Percent; ?>%" aria-valuenow="<?php echo $option1Percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $option1Percent; ?></div>
                                </div>
                                <p>Playing holi with my family inside my house:</p>
                                <div class="progress mb-4">
                                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?php echo $option2Percent; ?>%" aria-valuenow="<?php echo $option2Percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $option2Percent; ?></div>
                                </div>
                                <p>Playing Holi outdoors:</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?php echo $option3Percent; ?>%" aria-valuenow="<?php echo $option3Percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $option3Percent; ?></div>
                                </div>
                            </div>
<?php
                        } else {
?>
                            <form action="" method="POST">
                                <div class="form-check m-3">
                                    <label class="form-check-label">Not playing Holi. Just celebrating with wishes and sweets.</label>
                                    <input class="form-check-input" name="holi" type="radio" value="option1" checked>
                                </div>

                                <div class="form-check m-3">
                                    <label class="form-check-label">Playing holi with my family inside my house.</label>
                                    <input class="form-check-input" name="holi" type="radio" value="option2">
                                </div>

                                <div class="form-check m-3">
                                    <label class="form-check-label">Playing Holi outdoors.</label>
                                    <input class="form-check-input" name="holi" type="radio" value="option3">
                                </div>
                                <button type="submit" name="submitSurvey" class="btn btn-success m-3">Submit</button>
                            </form>
<?php
                        }
?>
                    </div>
                </div>
                <div class="pb-4 p-2 flex-fill bd-highlight flex-grow-1">
                    <h5>Do's and Dont's for Holi 2021:</h5>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-danger">Don't invite people from outside to celebrate the festival at your home.</li>
                        <li class="list-group-item list-group-item-success">Avoid handshakes and hugging during celebrations. Say Namaste!</li>
                        <li class="list-group-item list-group-item-primary">Avoid gathering and maintain social distancing around the pyre for celebratory Holika Dahan.</li>
                        <li class="list-group-item list-group-item-warning">Don't take part in celebrations or allow anybody else if there are symptoms of cold or influenza. Avoid taking part in celebrations even in case of mild cold or cough.</li>
                        <li class="list-group-item list-group-item-info">People in vulnerable age groups, that is, those above 60, people with co-morbidities and those below 10 are advised not to go out during festivals.</li>
                        <li class="list-group-item list-group-item-dark">Maintain hand hygiene attentively: no handshake and mandatory hand sanitisation.</li>
                        <li class="list-group-item list-group-item-light">Don't be lax in following Covid-19 protocol fully. Wear a face mask if you go out or meet somebody outside your family. Don't take off your face mask even during playing with colours.</li>
                      </ul>
                </div>
            </div>
            <hr/>
            <!-- Holi Content Ends -->
            <div class="col-4"><center><a href="map.php" class="btn btn-danger btn-lg btn-block">Planet Society Covid Map</a></center></div>
            <div class="col-4"><center><a href="pune.php" class="btn btn-warning btn-lg btn-block">Current Covid Spread in Pune</a></center></div>
            <div class="col-4"><center><a href="protectYourself.php" class="btn btn-success btn-lg btn-block">Learn How to Protect Yourself</a></div></center>
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
