<?php
include('header.php');
require('connect.php');
require('viewsCounter.php');

updateViewCount('plasma');

$query = "SELECT * FROM plasma";
$result = mysqli_query($conn, $query);

$plasmaArr = array();
while($row = mysqli_fetch_assoc($result)) {
    $plasmaArr[] = $row;
}

$today = date("d-m-Y");

if(isset($_POST['requestPlasma'])) {
    $bloodgroup = mysqli_real_escape_string($conn, trim($_POST['bloodgroup']));
    $loc = mysqli_real_escape_string($conn, trim($_POST['loc']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

    $query = "INSERT INTO plasma (bloodgroup, loc, phone, type, date) VALUES ('$bloodgroup', '$loc', '$phone', 'request', '$today')";
    if(mysqli_query($conn, $query)) {
        echo "<script type=\"text/javascript\"> alert('Your request has been submitted!'); location.href = 'plasma.php'; </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

if(isset($_POST['donatePlasma'])) {
    $bloodgroup = mysqli_real_escape_string($conn, trim($_POST['bloodgroup']));
    $loc = mysqli_real_escape_string($conn, trim($_POST['loc']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

    $query = "INSERT INTO plasma (bloodgroup, loc, phone, type, date) VALUES ('$bloodgroup', '$loc', '$phone', 'donate', '$today')";
    if(mysqli_query($conn, $query)) {
        echo "<script type=\"text/javascript\"> alert('Thank you volunteering!'); location.href = 'plasma.php'; </script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request or Donate Plasma</title>
    <link href="css/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pb-5 mb-5">
                <br/>
                <a href="index.php" class="btn btn-danger ">Return back to Home</a>
                <div class="row">
                    <div class="col-6">
                        <h3 class="ml-4 mt-3">Request a plasma donor:</h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="bloodgroup" class="ml-3"><b>Blood Group:</b></label>
                                <select class="form-select" name="bloodgroup" aria-label="Blood Group" required>
                                    <option value="">Select Required Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                <label for="loc" class="ml-3"><b>Flat No/RH:</b></label>
                                <input type="text" class="form-control ml-2" name="loc" placeholder="Enter your Flat No or RH" required>
                                <label for="tel" class="ml-3"><b>Contact Number:</b></label>
                                <input type="text" class="form-control ml-2" name="phone" placeholder="Enter 10 digits mobile number" pattern="[0-9]{10}" required value="">
                                <button type="submit" name="requestPlasma" class="btn btn-success ml-3 mt-3"><i class="fas fa-comment-alt"></i>Request Plasma</button>
                            </div>
                        </form>
                        <br/>
                        <hr/>
                        <h4>Plasma Donor Requests:</h4>
                        <table class="table table-bordered table-hover mt-4" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Blood Group</th>
                                    <th>Flat No/RH</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                for ($i=count($plasmaArr)-1; $i>=0; $i=$i-1) {
                                    if ($plasmaArr[$i]['type'] == "request") {
                            ?>
                                        <tr class="table-danger">
                                            <td><?php echo count($plasmaArr) - $i ?></td>
                                            <td><?php echo $plasmaArr[$i]['bloodgroup']; ?></td>
                                            <td><?php echo $plasmaArr[$i]['loc']; ?></td>
                                            <td><?php echo $plasmaArr[$i]['phone']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <h3 class="ml-4 mt-3">Volunteer to Donate Plasma:</h3>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="bloodgroup" class="ml-3"><b>Blood Group:</b></label>
                                <select class="form-select" name="bloodgroup" aria-label="Blood Group" required>
                                    <option value="">Select Your Blood Group</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                <label for="loc" class="ml-3"><b>Flat No/RH:</b></label>
                                <input type="text" class="form-control ml-2" name="loc" placeholder="Enter your Flat No or RH" required>
                                <label for="tel" class="ml-3"><b>Contact Number:</b></label>
                                <input type="text" class="form-control ml-2" name="phone" placeholder="Enter 10 digits mobile number" pattern="[0-9]{10}" required value="">
                                <button type="submit" name="donatePlasma" class="btn btn-success ml-3 mt-3"><i class="fas fa-comment-alt"></i>Volunteer to Donate Plasma</button>
                            </div>
                        </form>
                        <br/>
                        <hr/>
                        <h4>Plasma Donors:</h4>
                        <table class="table table-bordered table-hover mt-4" id="myTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Blood Group</th>
                                    <th>Flat No/RH</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                for ($i=count($plasmaArr)-1; $i>=0; $i=$i-1) {
                                    if ($plasmaArr[$i]['type'] == "donate") {
                            ?>
                                        <tr class="table-success">
                                            <td><?php echo count($plasmaArr) - $i ?></td>
                                            <td><?php echo $plasmaArr[$i]['bloodgroup']; ?></td>
                                            <td><?php echo $plasmaArr[$i]['loc']; ?></td>
                                            <td><?php echo $plasmaArr[$i]['phone']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="col-12 col-xl-6">
                <h3 class="">What is Plasma?</h3>
                <ul class="list-group">
                    <li class="list-group-item">Plasma is the liquid part of your blood made up of about 90% water and makes up 50% of total blood volume</li>
                    <li class="list-group-item">Plasma has antibodies that help fight infection, plus proteins called albumin and fibrinogen.</li>
                    <li class="list-group-item">Just 1 donation can save up to 3 lives.</li>
                    <li class="list-group-item">Plasma donation takes about 45 to 60 minutes.</li>
                    <li class="list-group-item">Friends and family members can donate blood for their loved ones.</li>
                </ul>
            </div>
            <div class="col-12 col-xl-6">
                <h3 class="">Who can donate Plasma?</h3>
                <ul class="list-group">
                    <li class="list-group-item">You have to be at least 18 years old and weigh at least 50 kgs.</li>
                    <li class="list-group-item">People who have <b>fully recovered from COVID-19 for at least two weeks</b>.</li>
                    <li class="list-group-item">If you have type AB blood, you are a universal plasma donor.</li>
                    <li class="list-group-item">You may donate plasma every 28 days.</li>
                    <li class="list-group-item">While 1/3rd of the population is eligible to give blood, less than 1/50th actually donate</li>
                </ul>
            </div>
            <div class="col-12">
                <br/>
                <h3 class="mt-4">Blood Type Compatibility Chart:</h3>
                <table class="table table-bordered table-hover mb-5" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Blood Type</th>
                            <th>Percent of Population</th>
                            <th class="table-success">Can donate plasma to</th>
                            <th class="table-success">Can receive plasma from</th>
                            <th>Can donate red blood cells to</th>
                            <th>Can receive red blood cells from</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-danger">O+</td>
                            <td>37%</td>
                            <td>O, O-</td>
                            <td>Everyone</td>
                            <td>O, A, B, AB</td>
                            <td>O, O-</td>
                            <td>O+ is universal receiver of plasma</td>
                        </tr>
                        <tr>
                            <td class="table-danger">O-</td>
                            <td>6%</td>
                            <td>O, O-</td>
                            <td>Everyone</td>
                            <td>Everyone</td>
                            <td>O-</td>
                            <td>O- is universal receiver of plasma & universal donor of red blood cells</td>
                        </tr>
                        <tr>
                            <td class="table-danger">A+</td>
                            <td>34%</td>
                            <td>A, A-, O, O-</td>
                            <td>A, A-, AB, AB-</td>
                            <td>A, AB</td>
                            <td>A, A-, O, O-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="table-danger">A-</td>
                            <td>6%</td>
                            <td>A, A-, O, O-</td>
                            <td>A, A-, AB, AB-</td>
                            <td>A, A-, AB, AB-</td>
                            <td>A-, O-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="table-danger">B+</td>
                            <td>10%</td>
                            <td>B, B-, O, O-</td>
                            <td>B, B-, AB, AB-</td>
                            <td>B, AB</td>
                            <td>B, B-, O, O-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="table-danger">B-</td>
                            <td>2%</td>
                            <td>B, B-, O, O-</td>
                            <td>B, B-, AB, AB-</td>
                            <td>B, B-, AB, AB-</td>
                            <td>B-, O-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="table-danger">AB+</td>
                            <td>4%</td>
                            <td>Everyone</td>
                            <td>AB, AB-</td>
                            <td>AB</td>
                            <td>Everyone</td>
                            <td>AB+ is universal donor of plasma & universal receiver of red blood cells</td>
                        </tr>
                        <tr>
                            <td class="table-danger">AB-</td>
                            <td>1%</td>
                            <td>Everyone</td>
                            <td>AB, AB-</td>
                            <td>AB, AB-</td>
                            <td>AB-, A-, B-, O-</td>
                            <td>AB- is universal donor of plasma</td>
                        </tr>
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
