am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end
    
    // Create chart
    var chart = am4core.create("graph1", am4charts.XYChart);
    chart.paddingRight = 20;
    
    chart.data = generateChartData();

    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.baseInterval = {
      "timeUnit": "minute",
      "count": 1
    };
    dateAxis.tooltipDateFormat = "HH:mm, d MMMM";
    
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.tooltip.disabled = true;
    valueAxis.title.text = "HRV values";
    
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.dateX = "date";
    series.dataFields.valueY = "HRV_value";
    series.tooltipText = "HRV: [bold]{valueY}[/]";
    series.fillOpacity = 0.3;
    
    
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineY.opacity = 0;
    chart.scrollbarX = new am4charts.XYChartScrollbar();
    chart.scrollbarX.series.push(series);
    
    
    dateAxis.start = 0.0;
    dateAxis.keepSelection = true;

    function generateChartData() {
        var chartData = [];
        // current date
        var firstDate = new Date();
        // now set 500 minutes back
        firstDate.setMinutes(firstDate.getDate() - 500);
    
        // and generate 500 data items
        var HRV_value = 70;
        for (var i = 0; i < 500; i++) {
            var newDate = new Date(firstDate);
            // each time we add one minute
            newDate.setMinutes(newDate.getMinutes() + i);
            // some random number
            HRV_value += Math.round((Math.random()<0.5?1:-1)*Math.random()*1.7);
            // add data item to the array
            chartData.push({
                date: newDate,
                HRV_value: HRV_value
            });
        }
        return chartData;
    }
    
    }); // end am4core.ready()