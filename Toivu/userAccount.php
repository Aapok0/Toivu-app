<?php
  include("includes/iheader.php");
?>

    <div class="page-container">

        <!-- Päänavigaatio -->
        <nav>
            <div class="container nav-bar">

                <!-- Logo vasempaan ylälaitaan -->
                <div id="logo" class="six columns">
                    <a href="index.php">
                    <img src="images/Toivu-logo_white-regular.png" alt="Toivu-logo">
                    </a>
                </div>

                <div class="three columns navi">
                    <ul>
                        <li><a href="index.php">Koti</a></li>
                        <li><a href="infoPage.php">Tietoa</a></li>
                    </ul>
                </div>

                <!-- Käyttäjätunnistus -->
                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki -->
                <div class="three columns navi">
                    <?php
                        include("includes/inavIndex.php");
                    ?>
                </div>

            </div>
        </nav>

        <div class="container">
            <div class="twelve columns">
                <h1>
                    <?php
                        echo($_SESSION['suserName'] . ":n oma sivu");
                    ?>
                </h1>

                <div>
                    <?php
                        include("includes/rmssd.php");

                        $hrv_string = file_get_contents("HRV-demodata/good/good1.json");
                        $hrv_arr = json_decode($hrv_string, true);
                        //var_dump($hrv_arr["R-R"]);

                        echo readiness($hrv_arr["R-R"]);
                    ?>
                </div>
            </div>

            <div class="twelve columns">
                <h3>Testigraafi 1</h3>
                <div id="graph1"></div>

                <!-- Resources -->
                <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
                <script src="js/ToivuTheme.js"></script>
                
                <script src="js/graph1.js"></script>
            </div>

            <div class="twelve columns">
                <h3>Testigraafi 2</h3>
                <div id="graph2"></div>
                <script src="js/graph2.js"></script>
            </div>

            <div class="twelve columns">
                <h3>Testikalenteri</h3>
                <div id="calendar"></div>
            </div>
        </div>

<?php
    include("includes/ifooter.php");
?>