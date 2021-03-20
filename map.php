<?php
include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Active Cases Map - PM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="footer.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style type="text/css">
        #zone-image-container {
            position: relative;
        }

        img {
            width: 1898px;
            height:378px;
        }

        .zone-circle {
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 40px;
            border: 5px solid red;

        }

        .zone-A1 {
            left: 79px;
            top: 94px;
        }

        .zone-A2 {
            left: 155px;
            top: 91px;
        }

        .zone-A3 {
            left: 274px;
            top: 89px;
        }

        .zone-A4 {
            left: 369px;
            top: 94px;
        }

        .zone-A5 {
            left: 478px;
            top: 101px;
        }

        .zone-A6 {
            left: 573px;
            top: 107px;
        }

        .zone-A7 {
            left: 723px;
            top: 104px;
        }

        .zone-A8 {
            left: 811px;
            top: 109px;
        }

        .zone-A9 {
            left: 1012px;
            top: 149px;
        }

        .zone-A10 {
            left: 1100px;
            top: 159px;
        }

        .zone-A11 {
            left: 1241px;
            top: 146px;
        }

        .zone-A12 {
            left: 1322px;
            top: 149px;
        }

        .zone-A13 {
            left: 1475px;
            top: 162px;
        }

        .zone-A14 {
            left: 1551px;
            top: 166px;
        }

        .zone-A15 {
            left: 1689px;
            top: 173px;
        }

        .zone-A16 {
            left: 1774px;
            top: 177px;
        }

        .zone-RH1 {
            left: 287px;
            top: 210px;
        }

        .zone-RH2 {
            left: 330px;
            top: 211px;
        }

        .zone-RH3 {
            left: 367px;
            top: 211px;
        }

        .zone-RH4 {
            left: 398px;
            top: 212px;
        }

        .zone-RH5 {
            left: 433px;
            top: 210px;
        }

        .zone-RH6 {
            left: 463px;
            top: 212px;
        }

        .zone-RH7 {
            left: 494px;
            top: 211px;
        }

        .zone-RH8 {
            left: 530px;
            top: 212px;
        }

        .zone-RH9 {
            left: 627px;
            top: 212px;
        }

        .zone-RH10 {
            left: 658px;
            top: 224px;
        }

        .zone-RH11 {
            left: 694px;
            top: 215px;
        }

        .zone-RH12 {
            left: 724px;
            top: 225px;
        }

        .zone-RH13 {
            left: 759px;
            top: 215px;
        }

        .zone-RH14 {
            left: 780px;
            top: 230px;
        }

        .zone-RH15 {
            left: 816px;
            top: 219px;
        }

        .zone-RH16 {
            left: 851px;
            top: 228px;
        }

        .zone-RH17 {
            left: 920px;
            top: 218px;
        }

        .zone-RH18 {
            left: 950px;
            top: 218px;
        }

        .zone-RH19 {
            left: 973px;
            top: 228px;
        }

        .zone-RH20 {
            left: 1003px;
            top: 215px;
        }

        .zone-RH21 {
            left: 1042px;
            top: 228px;
        }

        .zone-RH22 {
            left: 1074px;
            top: 220px;
        }

        .zone-RH23 {
            left: 1099px;
            top: 233px;
        }

        .zone-RH24 {
            left: 1129px;
            top: 216px;
        }

        .zone-RH25 {
            left: 1238px;
            top: 242px;
        }

        .zone-RH26 {
            left: 1265px;
            top: 255px;
        }

        .zone-RH27 {
            left: 1306px;
            top: 248px;
        }

        .zone-RH28 {
            left: 1331px;
            top: 264px;
        }

        .zone-RH29 {
            left: 1367px;
            top: 247px;
        }

        .zone-RH30 {
            left: 1391px;
            top: 269px;
        }

        .zone-RH31 {
            left: 1425px;
            top: 254px;
        }

        .zone-RH32 {
            left: 1463px;
            top: 251px;
        }

        .zone-RH33 {
            left: 1505px;
            top: 257px;
        }

        .zone-RH34 {
            left: 1530px;
            top: 274px;
        }

        .zone-RH35 {
            left: 1567px;
            top: 265px;
        }

        .zone-RH36 {
            left: 1594px;
            top: 279;
        }

        .zone-RH37 {
            left: 1634px;
            top: 263px;
        }

        .zone-RH38 {
            left: 1667px;
            top: 283px;
        }

        .zone-RH39 {
            left: 1706px;
            top: 270px;
        }

        .zone-RH40 {
            left: 1741px;
            top: 285px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <h4 class="pt-3">Active Cases Map:</h4>
            <div id="zone-image-container">
                <img src="map.png" id="map"/>
            </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Made with ❤️ by Rajan</p>
    </div>
</body>

<script type="text/javascript">
    function getCasesData() {
        return JSON.parse($.ajax({
            async: false,
            url: 'fetchCases.php',
            type: 'POST',
            data: {},
            dataType: 'JSON',
            success:function(response) {}
        }).responseText);
    }

    var casesArr = getCasesData();

    function drawZones(zoneList) {
      var container = document.getElementById('zone-image-container');

      //  Remove existing circles.
      for (var i = container.children.length - 1; i > 0; i--) {
        container.removeChild(container.children[i]);
      }

      //  Add circles.
      for (var i = 0; i < zoneList.length; i++) {
        var zone = document.createElement('div');
        zone.className = 'zone-circle zone-' + zoneList[i];
        container.appendChild(zone);
      }
    }

    zones = []
    var today = new Date();
    for (var i = 0; i < casesArr.length; i++) {
        var caseDate = new Date(casesArr[i]['date']);
        var daydiff = parseInt((today - caseDate) / (1000 * 60 * 60 * 24), 10);
        if (daydiff < 14) {
            loc = casesArr[i]['loc'].match(/\d+/)[0];
            if (casesArr[i]['loc'][0] == 'A') {
                loc = 'A' + casesArr[i]['loc'].match(/\d+/)[0];
                zones.push(loc);
            } else {
                loc = 'RH' + casesArr[i]['loc'].match(/\d+/)[0];
                zones.push(loc);
            }
        }
    }
    drawZones(zones);
</script>
</html>
