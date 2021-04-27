<?php
    //Graafin tulostus sivulle
    echo "<div class=\"twelve columns\">";
        echo "<h2 class=\"text-center\">Levollisuusanalyysi</h2>";
        echo "Analysoimme sinun levollisuutta ja palautumista kahdella eri tavalla ja pyrimme antamaan niiden yhdistelmällä mahdollisimman tarkan kuvan voinnistasi. Readiness arvioi leposykevälien keskimääräistä vaihtelua kokonaisuudessaan ja pNN50 laskee peräkkäisiä yli 50 milliseknnunin vaihteluita mittauksissasi. Lisää näistä analyyseista ja niiden teoreettisesta pohjasta voi lukea alla olevista linkeistä.";
        echo "<br><a class=\"form_link\" href=\"https://www.duodecimlehti.fi/duo50084\" target=\"_blank\" rel=\"noopener noreferrer\">Duodecim: Sydämen sykevaihtelun mittaaminen ja merkitys</a>";
        echo "<br><a class=\"form_link\" href=\"https://www.kubios.com/hrv-analysis-methods/\" target=\"_blank\" rel=\"noopener noreferrer\">Kubios: HRV ANALYSIS METHODS</a>";
        echo "<br><a class=\"form_link\" href=\"https://www.ncbi.nlm.nih.gov/pmc/articles/PMC5624990/#:~:text=used%20in%20biofeedback.-,RMSSD,of%20the%20total%20is%20obtained.\" target=\"_blank\" rel=\"noopener noreferrer\">Frontiers in Public Health: An Overview of Heart Rate Variability Metrics and Norms</a>";
        echo "<div id=\"graph3\"></div>";
    echo "</div>";
?>

<script>
    //Datan haku APIsta
    //fetch('https://users.metropolia.fi/~ronihei/WSK12021/ToivuApp/Toivu/API/graph3API.php')
    fetch('https://users.metropolia.fi/~aapokok/WSK12021/Toivu/API/graph3API.php')
    
    .then((response) => {
        return response.json();
    })
    .then((data) => {   
    
    //Graafin javascript
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    am4core.useTheme(ToivuTheme);
    // Themes end

    // Create chart instance
    var chart = am4core.create("graph3", am4charts.XYChart);

    // Choose chart language
    chart.language.locale = am4lang_fi_FI;

    // Increase contrast by taking evey second color
    chart.colors.step = 2;

    // Add data
    chart.data = data;

    // Create axes
    var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
    dateAxis.renderer.minGridDistance = 50;

    // Create series
    function createAxisAndSeries(field, name, opposite, bullet) {
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    if(chart.yAxes.indexOf(valueAxis) != 0){
        valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
    }
    
    var series = chart.series.push(new am4charts.LineSeries());
    series.dataFields.valueY = field;
    series.dataFields.dateX = "date";
    series.strokeWidth = 2;
    series.yAxis = valueAxis;
    series.name = name;
    series.tooltipText = "{name}: [bold]{valueY}[/]";
    series.tensionX = 0.8;
    series.showOnInit = true;
    
    var interfaceColors = new am4core.InterfaceColorSet();
    
    switch(bullet) {
        case "triangle":
        var bullet = series.bullets.push(new am4charts.Bullet());
        bullet.width = 12;
        bullet.height = 12;
        bullet.horizontalCenter = "middle";
        bullet.verticalCenter = "middle";
        
        var triangle = bullet.createChild(am4core.Triangle);
        triangle.stroke = interfaceColors.getFor("background");
        triangle.strokeWidth = 2;
        triangle.direction = "top";
        triangle.width = 12;
        triangle.height = 12;
        break;

        default:
        var bullet = series.bullets.push(new am4charts.CircleBullet());
        bullet.circle.stroke = interfaceColors.getFor("background");
        bullet.circle.strokeWidth = 2;
        break;
    }
    
    valueAxis.renderer.line.strokeOpacity = 1;
    valueAxis.renderer.line.strokeWidth = 2;
    valueAxis.renderer.line.stroke = series.stroke;
    valueAxis.renderer.labels.template.fill = series.stroke;
    valueAxis.renderer.opposite = opposite;
    }

    createAxisAndSeries("readiness", "Readiness", true, "circle");
    createAxisAndSeries("pNN50", "pNN50 (%)", true, "triangle");

    // Add legend
    chart.legend = new am4charts.Legend();

    // Add cursor
    chart.cursor = new am4charts.XYCursor();

    }); // end am4core.ready()
});
</script>