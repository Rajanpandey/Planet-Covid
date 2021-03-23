<?php
function getIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function updateViewCount($pageName) {
    require('connect.php');

    $today = date("Y-m-d");
    $ip = getIpAddress();

    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM views WHERE page='$pageName' AND date='$today' AND ip='$ip'"))) {
        $query = "UPDATE views SET count = count + 1 WHERE page='$pageName' AND date='$today' AND ip='$ip'";
    }
    else {
        $query = "INSERT INTO views (page, count, date, ip) VALUES ('$pageName', 1, '$today', '$ip')";
    }


    mysqli_query($conn, $query);

    mysqli_close($conn);
}
?>
