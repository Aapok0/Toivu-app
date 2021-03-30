<?php
  include("includes/iheader.php");
?>

    <div class="page-container">

        <!-- Päänavigaatio -->
        <nav>
            <div class="container nav-bar">

                <!-- Logo vasempaan ylälaitaan -->
                <div class="six columns">
                    <h1>Logo</h1>
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
            </div>
        </div>

<?php
    include("includes/ifooter.php");
?>