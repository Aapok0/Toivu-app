<?php
    //Graafin tulostus sivulle
    echo "<div class=\"twelve columns\">";
        echo "<h2 class=\"text-center\">Keskimääräinen sykevälivaihtelu (ms)</h2>";
        echo "<p>Graafissa voit nähdä kuinka paljon sykevälisi keskimäärin vaihtelee sykkeestä sykkeeseen kunkin mittauksen aikana. Arvot ovat millisekunneissa ja korkeampi arvo tarkoittaa, että olet ollut levollisempi ja palautuneempi.</p>";
        echo "<div id=\"graph1\"></div>";
    echo "</div>";
?>

<script>
    //Datan haku APIsta
    //fetch('https://users.metropolia.fi/~ronihei/WSK12021/ToivuApp/Toivu/API/graph1API.php')
    fetch('https://users.metropolia.fi/~aapokok/WSK12021/Toivu/API/graph1API.php')
    
    .then((response) => {
        return response.json();
    })
    .then((data) => {   
    
        // alku am4core.ready()
        am4core.ready(function() {

            // Teemat alkaa
            am4core.useTheme(am4themes_animated);
            am4core.useTheme(ToivuTheme);
            // Teemat loppuu

            // Luodaan kaavio-instanssi
            var chart = am4core.create("graph1", am4charts.XYChart);

            // Valitaan kaavion kieli
            chart.language.locale = am4lang_fi_FI;

            // Lisätään data
            chart.data = data;

            // Asetetaan syötteiden päiväformaatti
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Luodaan akselit
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.title.text = "Sykevälivaihtelu";

            // Luodaan sarjat
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "[bold]{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

            // Neuvot, jotka ilmestyy, kun pitää hiirtä tietyssä kohdassa
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            // Luettelomerkit kasvaa, kun niiden päälle mennään hiirellä
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.5;

            // Tehdään panoroiva kursori
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;

            // Luodaan pystysuora skrolli ja asetetaan ennen arvoakselia
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Luodaan vaakasuora skrolli esikatselulla ja asetetaan päiväakselin alle
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.00;
            dateAxis.keepSelection = true;

        }); // loppu am4core.ready()
    });
</script>