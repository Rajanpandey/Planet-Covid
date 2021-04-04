function getPlanetCasesData() {
    return JSON.parse($.ajax({
        async: false,
        url: 'fetchCasesGroupByDate.php',
        type: 'POST',
        data: {},
        dataType: 'JSON',
        success:function(response) {}
    }).responseText);
}

var planetCasesArr = getPlanetCasesData();

var formattedPlanetData = [];

var now = new Date();
var cumulativeCount = 0;
var i = 0;
var idx = 0;
for (var d = new Date('2020-7-21'); d <= now; d.setDate(d.getDate() + 1)) {
    var data = {};
    formattedD = (d.getFullYear() + '-' + ('0' + (d.getMonth()+1)).slice(-2) + '-' + ('0' + d.getDate()).slice(-2));
    data['date'] = formattedD;
    if (i < planetCasesArr.length && (new Date(planetCasesArr[i]['date']).getFullYear() + '-' + ('0' + (new Date(planetCasesArr[i]['date']).getMonth() + 1)).slice(-2) + '-' + ('0' + new Date(planetCasesArr[i]['date']).getDate()).slice(-2) === formattedD)) {
        data['delConfirmed'] = parseInt(planetCasesArr[i]['SUM(count)']);
        cumulativeCount += parseInt(planetCasesArr[i]['SUM(count)']);
        i++;
    } else {
        data['delConfirmed'] = 0;
    }
    if (d < new Date('2020-8-5')) {
        data['active'] = 1;
    } else {
        console.log('in')
        data['active'] = cumulativeCount - formattedPlanetData[idx - 14]['confirmed'];
    }
    data['confirmed'] = cumulativeCount;
    formattedPlanetData.push(data);
    idx++;
}

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("dailyNewConfirmPlanet", am4charts.XYChart);

    chart.data = formattedPlanetData;

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "delConfirmed";
    series.dataFields.dateX = "date";
    series.strokeWidth = 2;
    series.minBulletDistance = 10;
    series.tooltipText = "{valueY}";
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.background.cornerRadius = 20;
    series.tooltip.background.fillOpacity = 0.5;
    series.tooltip.label.padding(12,12,12,12)

    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.xAxis = dateAxis;
    chart.cursor.snapToSeries = series;

    function generateChartData() {
        var chartData = [];
        var firstDate = new Date();
        firstDate.setDate(firstDate.getDate() - 1000);
        var visits = 1200;
        for (var i = 0; i < 500; i++) {
            var newDate = new Date(firstDate);
            newDate.setDate(newDate.getDate() + i);

            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

            chartData.push({
                date: newDate,
                visits: visits
            });
        }
        return chartData;
    }
});

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("totalConfirmPlanet", am4charts.XYChart);

    chart.data = formattedPlanetData;

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "confirmed";
    series.dataFields.dateX = "date";
    series.strokeWidth = 2;
    series.minBulletDistance = 10;
    series.tooltipText = "{valueY}";
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.background.cornerRadius = 20;
    series.tooltip.background.fillOpacity = 0.5;
    series.tooltip.label.padding(12,12,12,12)

    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.xAxis = dateAxis;
    chart.cursor.snapToSeries = series;

    function generateChartData() {
        var chartData = [];
        var firstDate = new Date();
        firstDate.setDate(firstDate.getDate() - 1000);
        var visits = 1200;
        for (var i = 0; i < 500; i++) {
            var newDate = new Date(firstDate);
            newDate.setDate(newDate.getDate() + i);

            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

            chartData.push({
                date: newDate,
                visits: visits
            });
        }
        return chartData;
    }
});

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("totalActivePlanet", am4charts.XYChart);

    chart.data = formattedPlanetData;

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "active";
    series.dataFields.dateX = "date";
    series.strokeWidth = 2;
    series.minBulletDistance = 10;
    series.tooltipText = "{valueY}";
    series.tooltip.pointerOrientation = "vertical";
    series.tooltip.background.cornerRadius = 20;
    series.tooltip.background.fillOpacity = 0.5;
    series.tooltip.label.padding(12,12,12,12)

    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.xAxis = dateAxis;
    chart.cursor.snapToSeries = series;

    function generateChartData() {
        var chartData = [];
        var firstDate = new Date();
        firstDate.setDate(firstDate.getDate() - 1000);
        var visits = 1200;
        for (var i = 0; i < 500; i++) {
            var newDate = new Date(firstDate);
            newDate.setDate(newDate.getDate() + i);

            visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

            chartData.push({
                date: newDate,
                visits: visits
            });
        }
        return chartData;
    }
});
