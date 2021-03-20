<?php
include('header.php');
require('connect.php');

$today = new DateTime();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn, "INSERT INTO views () VALUES ()");

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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Covid Status - PM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="footer.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid pt-3 pb-5">
        <div class="row">
            <div class="col-12 table-responsive">
                <h4>Active Cases in Planet Millennium: <span class="text-danger"><?php echo $activeCases ?></span>/<?php echo $totalCases ?></h4>
                <p><b class="text-danger">Note:</b> These are the reported cases that we know. As most of the cases are asymptomatic, there can be x6-x10 more cases.</p>
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
