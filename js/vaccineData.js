function getVaccineData() {
    return JSON.parse($.ajax({
        async: false,
        url: 'vaccineCSV.php',
        type: 'POST',
        data: {},
        dataType: 'JSON',
        success:function(response) {}
    }).responseText);
}

var vaccineData = getVaccineData();

var formattedData = [];

for (var i = 6; i < vaccineData[0].length; i += 10) {
    var data = {};
    data['date'] = new Date(vaccineData[0][i].split("/").reverse().join("-"));
    data['TotalIndividualsRegistered'] = parseInt(vaccineData[1][i]);
    data['TotalSessionsConducted'] = parseInt(vaccineData[1][i + 1]);
    data['TotalSites'] = parseInt(vaccineData[1][i + 2]);
    data['FirstDoseAdministered'] = parseInt(vaccineData[1][i + 3]);
    data['SecondDoseAdministered'] = parseInt(vaccineData[1][i + 4]);
    data['Male'] = parseInt(vaccineData[1][i + 5]);
    data['Female'] = parseInt(vaccineData[1][i + 6]);
    data['Transgender'] = parseInt(vaccineData[1][i + 7]);
    data['TotalCovaxinAdministered'] = parseInt(vaccineData[1][i + 8]);
    data['TotalCoviShieldAdministered'] = parseInt(vaccineData[1][i + 9]);
    data['TotalVaccine'] = parseInt(vaccineData[1][i + 8]) + parseInt(vaccineData[1][i + 9]);
    formattedData.push(data);
}

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("totalVaccine", am4charts.XYChart);

    chart.data = formattedData;

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = "TotalVaccine";
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

    var chart = am4core.create("gender", am4charts.PieChart);

    chart.data = [
        {
          "Gender": "Male",
          "Vaccinated": data['Male']
        }, {
          "Gender": "Female",
          "Vaccinated": data['Female']
        }, {
          "Gender": "Transgender",
          "Vaccinated": data['Transgender']
        }
    ];

    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "Vaccinated";
    pieSeries.dataFields.category = "Gender";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;

    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

});

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);

    var chart = am4core.create("vaccine", am4charts.PieChart);

    chart.data = [
        {
          "Vaccine": "Covaxin",
          "Administered": data['TotalCovaxinAdministered']
        }, {
          "Vaccine": "CoviShield",
          "Administered": data['TotalCoviShieldAdministered']
        }
    ];

    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "Administered";
    pieSeries.dataFields.category = "Vaccine";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;

    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

});

am4core.ready(function() {
    am4core.useTheme(am4themes_animated);

    var chart = am4core.create("secondVsFirstDose", am4charts.GaugeChart);
    chart.innerRadius = am4core.percent(82);

    /**
     * Normal axis
     */
    var axis = chart.xAxes.push(new am4charts.ValueAxis());
    axis.min = 0;
    axis.max = 100;
    axis.strictMinMax = true;
    axis.renderer.radius = am4core.percent(80);
    axis.renderer.inside = true;
    axis.renderer.line.strokeOpacity = 1;
    axis.renderer.ticks.template.disabled = false
    axis.renderer.ticks.template.strokeOpacity = 1;
    axis.renderer.ticks.template.length = 10;
    axis.renderer.grid.template.disabled = true;
    axis.renderer.labels.template.radius = 40;
    axis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "%";
    })

    /**
     * Axis for ranges
     */
    var colorSet = new am4core.ColorSet();

    var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
    axis2.min = 0;
    axis2.max = 100;
    axis2.strictMinMax = true;
    axis2.renderer.labels.template.disabled = true;
    axis2.renderer.ticks.template.disabled = true;
    axis2.renderer.grid.template.disabled = true;

    var range0 = axis2.axisRanges.create();
    range0.value = 0;
    range0.endValue = 50;
    range0.axisFill.fillOpacity = 1;
    range0.axisFill.fill = colorSet.getIndex(0);

    var range1 = axis2.axisRanges.create();
    range1.value = 50;
    range1.endValue = 100;
    range1.axisFill.fillOpacity = 1;
    range1.axisFill.fill = colorSet.getIndex(2);

    /**
     * Label
     */
    var label = chart.radarContainer.createChild(am4core.Label);
    label.isMeasured = false;
    label.fontSize = 45;
    label.x = am4core.percent(50);
    label.y = am4core.percent(100);
    label.horizontalCenter = "middle";
    label.verticalCenter = "bottom";
    label.text = "50%";

    /**
     * Hand
     */
    var hand = chart.hands.push(new am4charts.ClockHand());
    hand.axis = axis2;
    hand.innerRadius = am4core.percent(20);
    hand.startWidth = 10;
    hand.pin.disabled = true;
    hand.value = data['SecondDoseAdministered'] / data['FirstDoseAdministered'] * 100;

    hand.events.on("propertychanged", function(ev) {
      range0.endValue = ev.target.value;
      range1.value = ev.target.value;
      label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
      axis2.invalidate();
    });
});

var SecondDoseAdministered = data['SecondDoseAdministered'];
var firstDoseAdministered = data['FirstDoseAdministered'];
am4core.ready(function() {
    am4core.useTheme(am4themes_animated);

    var chartMin = 0;
    var chartMax = 100;

    var data = {
      score: SecondDoseAdministered / firstDoseAdministered * 100,
      gradingData: [
        {
          title: "Less than 25%",
          color: "#f04922",
          lowScore: 0,
          highScore: 25
        },
        {
          title: "Less than 50%",
          color: "#ee1f25",
          lowScore: 25,
          highScore: 50
        },
        {
          title: "Greater than 50%",
          color: "#54b947",
          lowScore: 50,
          highScore: 75
        },
        {
          title: "Nearing 100%",
          color: "#0f9747",
          lowScore: 75,
          highScore: 100
        }
      ]
    };

    /**
    Grading Lookup
     */
    function lookUpGrade(lookupScore, grades) {
      // Only change code below this line
      for (var i = 0; i < grades.length; i++) {
        if (
          grades[i].lowScore < lookupScore &&
          grades[i].highScore >= lookupScore
        ) {
          return grades[i];
        }
      }
      return null;
    }

    // create chart
    var chart = am4core.create("secondVsFirstDose2", am4charts.GaugeChart);
    chart.hiddenState.properties.opacity = 0;
    chart.fontSize = 11;
    chart.innerRadius = am4core.percent(80);
    chart.resizable = true;

    /**
     * Normal axis
     */

    var axis = chart.xAxes.push(new am4charts.ValueAxis());
    axis.min = chartMin;
    axis.max = chartMax;
    axis.strictMinMax = true;
    axis.renderer.radius = am4core.percent(80);
    axis.renderer.inside = true;
    axis.renderer.line.strokeOpacity = 0.1;
    axis.renderer.ticks.template.disabled = false;
    axis.renderer.ticks.template.strokeOpacity = 1;
    axis.renderer.ticks.template.strokeWidth = 0.5;
    axis.renderer.ticks.template.length = 5;
    axis.renderer.grid.template.disabled = true;
    axis.renderer.labels.template.radius = am4core.percent(15);
    axis.renderer.labels.template.fontSize = "0.9em";

    /**
     * Axis for ranges
     */

    var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
    axis2.min = chartMin;
    axis2.max = chartMax;
    axis2.strictMinMax = true;
    axis2.renderer.labels.template.disabled = true;
    axis2.renderer.ticks.template.disabled = true;
    axis2.renderer.grid.template.disabled = false;
    axis2.renderer.grid.template.opacity = 0.5;
    axis2.renderer.labels.template.bent = true;
    axis2.renderer.labels.template.fill = am4core.color("#000");
    axis2.renderer.labels.template.fontWeight = "bold";
    axis2.renderer.labels.template.fillOpacity = 0.3;



    /**
    Ranges
    */

    for (let grading of data.gradingData) {
      var range = axis2.axisRanges.create();
      range.axisFill.fill = am4core.color(grading.color);
      range.axisFill.fillOpacity = 0.8;
      range.axisFill.zIndex = -1;
      range.value = grading.lowScore > chartMin ? grading.lowScore : chartMin;
      range.endValue = grading.highScore < chartMax ? grading.highScore : chartMax;
      range.grid.strokeOpacity = 0;
      range.stroke = am4core.color(grading.color).lighten(-0.1);
      range.label.inside = true;
      range.label.text = grading.title.toUpperCase();
      range.label.inside = true;
      range.label.location = 0.5;
      range.label.inside = true;
      range.label.radius = am4core.percent(10);
      range.label.paddingBottom = -5; // ~half font size
      range.label.fontSize = "0.9em";
    }

    var matchingGrade = lookUpGrade(data.score, data.gradingData);

    /**
     * Label 1
     */

    var label = chart.radarContainer.createChild(am4core.Label);
    label.isMeasured = false;
    label.fontSize = "6em";
    label.x = am4core.percent(50);
    label.paddingBottom = 15;
    label.horizontalCenter = "middle";
    label.verticalCenter = "bottom";
    //label.dataItem = data;
    label.text = data.score.toFixed(1);
    //label.text = "{score}";
    label.fill = am4core.color(matchingGrade.color);

    /**
     * Label 2
     */

    var label2 = chart.radarContainer.createChild(am4core.Label);
    label2.isMeasured = false;
    label2.fontSize = "2em";
    label2.horizontalCenter = "middle";
    label2.verticalCenter = "bottom";
    label2.text = matchingGrade.title.toUpperCase();
    label2.fill = am4core.color(matchingGrade.color);


    /**
     * Hand
     */

    var hand = chart.hands.push(new am4charts.ClockHand());
    hand.axis = axis2;
    hand.innerRadius = am4core.percent(55);
    hand.startWidth = 8;
    hand.pin.disabled = true;
    hand.value = data.score;
    hand.fill = am4core.color("#444");
    hand.stroke = am4core.color("#000");

    hand.events.on("positionchanged", function(){
      label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
      var value2 = axis.positionToValue(hand.currentPosition);
      var matchingGrade = lookUpGrade(axis.positionToValue(hand.currentPosition), data.gradingData);
      label2.text = matchingGrade.title.toUpperCase();
      label2.fill = am4core.color(matchingGrade.color);
      label2.stroke = am4core.color(matchingGrade.color);
      label.fill = am4core.color(matchingGrade.color);
    })
});
