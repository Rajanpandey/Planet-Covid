function getPuneData() {
    var Httpreq = new XMLHttpRequest();
    Httpreq.open("GET", 'https://api.covid19india.org/v4/min/timeseries-MH.min.json', false);
    Httpreq.send(null);
    return Httpreq.responseText;
}

var puneData = JSON.parse(getPuneData())['MH']['districts']['Pune']['dates'];
var formattedData = [];

keys = Object.keys(puneData);
for (var i = 0; i < keys.length; i++) {
    var key = keys[i];
    var data = {};
    data['date'] = new Date(key);
    if (puneData[key]['total']) {
        data['confirmed'] = puneData[key]['total']['confirmed'];
        data['active'] = puneData[key]['total']['confirmed'] - puneData[key]['total']['recovered'] - puneData[key]['total']['deceased'];
        data['recovered'] = puneData[key]['total']['recovered'];
        data['deceased'] = puneData[key]['total']['deceased'];
    }
    if (key !== '2020-04-26' && puneData[key]['delta']) {
        data['delConfirmed'] = puneData[key]['delta']['confirmed'];
        data['delActive'] = puneData[key]['delta']['confirmed'] - puneData[key]['delta']['recovered'] - puneData[key]['delta']['deceased'];
        data['delRecovered'] = puneData[key]['delta']['recovered'];
        data['delDeceased'] = puneData[key]['delta']['deceased'];
    }
    formattedData.push(data);
}

// am4core.ready(function() {
//     am4core.useTheme(am4themes_animated);
//     var chart = am4core.create("dailyNewConfirm", am4charts.XYChart);

//     chart.data = formattedData;

//     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//     var series = chart.series.push(new am4charts.LineSeries());

//     series.dataFields.valueY = "delConfirmed";
//     series.dataFields.dateX = "date";
//     series.tooltipText = "{delConfirmed}"

//     series.tooltip.pointerOrientation = "vertical";

//     chart.cursor = new am4charts.XYCursor();
//     chart.cursor.snapToSeries = series;
//     chart.cursor.xAxis = dateAxis;

//     //chart.scrollbarY = new am4core.Scrollbar();
//     chart.scrollbarX = new am4core.Scrollbar();
// });

// am4core.ready(function() {
//     am4core.useTheme(am4themes_animated);
//     var chart = am4core.create("totalConfirm", am4charts.XYChart);

//     chart.data = formattedData;

//     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//     var series = chart.series.push(new am4charts.LineSeries());

//     series.dataFields.valueY = "confirmed";
//     series.dataFields.dateX = "date";
//     series.tooltipText = "{confirmed}"

//     series.tooltip.pointerOrientation = "vertical";

//     chart.cursor = new am4charts.XYCursor();
//     chart.cursor.snapToSeries = series;
//     chart.cursor.xAxis = dateAxis;

//     //chart.scrollbarY = new am4core.Scrollbar();
//     chart.scrollbarX = new am4core.Scrollbar();
// });

// am4core.ready(function() {
//     am4core.useTheme(am4themes_animated);
//     var chart = am4core.create("totalActive", am4charts.XYChart);

//     chart.data = formattedData;

//     var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
//     var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
//     var series = chart.series.push(new am4charts.LineSeries());

//     series.dataFields.valueY = "active";
//     series.dataFields.dateX = "date";
//     series.tooltipText = "{active}"

//     series.tooltip.pointerOrientation = "vertical";

//     chart.cursor = new am4charts.XYCursor();
//     chart.cursor.snapToSeries = series;
//     chart.cursor.xAxis = dateAxis;

//     //chart.scrollbarY = new am4core.Scrollbar();
//     chart.scrollbarX = new am4core.Scrollbar();
// });

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("dailyNewConfirm", am4charts.XYChart);

    chart.data = formattedData;

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
    var chart = am4core.create("totalConfirm", am4charts.XYChart);

    chart.data = formattedData;

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
    var chart = am4core.create("totalActive", am4charts.XYChart);

    chart.data = formattedData;

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
