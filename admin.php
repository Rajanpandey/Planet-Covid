<?php
include('header.php');
require('connect.php');

if(isset($_POST['addCase'])) {
    $loc = mysqli_real_escape_string($conn, trim($_POST['loc']));
    $count = mysqli_real_escape_string($conn, trim($_POST['count']));
    $date = mysqli_real_escape_string($conn, trim($_POST['date']));

    $properDateFormat = date_format(new DateTime($date), "Y-m-d");
    $query = "INSERT INTO cases (loc, count, date) VALUES ('$loc', '$count', '$properDateFormat')";
    if (mysqli_query($conn, $query)) {
        echo "<script type=\"text/javascript\"> alert('Entry added!'); location.href = 'admin.php'; </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 pt-5">
                <h3 class="ml-3">Add a covid case:</h3>
                <form action="" method="POST" class="form-inline">
                    <div class="form-group">
                        <label for="loc" class="ml-3"><b>Infected Flat/RH:</b></label>
                        <input type="text" class="form-control ml-2" name="loc" placeholder="Address" required value="">
                        <label for="count" class="ml-3"><b>Count:</b></label>
                        <input type="number" class="form-control ml-2" name="count" placeholder="Address" required value="1" min="1">
                        <label for="date" class="ml-3"><b>Date:</b></label>
                        <input type="date" class="form-control ml-2" name="date" required value="">
                        <br/>
                        <button type="submit" name="addCase" class="btn btn-primary ml-3">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>
</html>
