<?php
include('header.php');
require('connect.php');

$today = new DateTime();
$colorCoding = [
    0 => 'table-success',
    1 => 'table-primary',
    2 => 'table-info',
    3 => 'table-warning',
    4 => 'table-danger',
    5 => 'table-dark',
    6 => 'table-secondary',
    7 => 'table-light',
];

$query = mysqli_query($conn, "SELECT * FROM views GROUP BY date, ip");
$viewsByDateAndIPArr = array();
while($row = mysqli_fetch_assoc($query)) {
    $viewsByDateAndIPArr[] = $row;
}

$query = mysqli_query($conn, "SELECT page, SUM(count), date FROM views GROUP BY date, page");
$viewsByDate = array();
while($row = mysqli_fetch_assoc($query)) {
    $viewsByDate[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Views</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">
                <h3 class="ml-3">View Count grouped Date:</h3>
                <table class="table table-bordered table-hover mt-4" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Page</th>
                            <th>Count</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for ($i=count($viewsByDate)-1; $i>=0; $i=$i-1) {
                            $daysPassed = $today->diff(new DateTime($viewsByDate[$i]['date']))->format('%a');
                    ?>
                            <tr class="<?php echo ($daysPassed <= 7) ? $colorCoding[$daysPassed] : '' ?>">
                                <td><?php echo count($viewsByDate) - $i ?></td>
                                <td><?php echo $viewsByDate[$i]['page']; ?></td>
                                <td><?php echo $viewsByDate[$i]['SUM(count)']; ?></td>
                                <td><?php echo $viewsByDate[$i]['date']; ?></td>
                            </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
                <h3 class="ml-3">Views grouped by IP and Date:</h3>
                <table class="table table-bordered table-hover mt-4" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Page</th>
                            <th>Count</th>
                            <th>IP</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        for ($i=count($viewsByDateAndIPArr)-1; $i>=0; $i=$i-1) {
                    ?>
                            <tr>
                                <td><?php echo count($viewsByDateAndIPArr) - $i ?></td>
                                <td><?php echo $viewsByDateAndIPArr[$i]['page']; ?></td>
                                <td><?php echo $viewsByDateAndIPArr[$i]['count']; ?></td>
                                <td><?php echo $viewsByDateAndIPArr[$i]['ip']; ?></td>
                                <td><?php echo $viewsByDateAndIPArr[$i]['date']; ?></td>
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
