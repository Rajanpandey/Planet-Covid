<?php
require('connect.php');

if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}

$query = "SELECT SUM(count), date FROM cases GROUP BY date";
$result = mysqli_query($conn, $query);

$casesArr = array();
while($row = mysqli_fetch_assoc($result)) {
    $casesArr[] = $row;
}
echo json_encode($casesArr);

mysqli_close($conn);
?>
