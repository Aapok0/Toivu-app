<?php
  include("includes/iheader.php");
?>

    <div id="page-container">

        <!-- Päänavigaatio -->
        <nav>
            <div id="nav-bar" class="container">

                <!-- Logo vasempaan ylälaitaan -->
                <div id="logo" class="six columns">
                    <a href="index.php">
                    <img src="images/Toivu-logo_white-regular.png" alt="Toivu-logo">
                    </a>
                </div>

                <div id="nav" class="three columns">
                    <ul>
                        <li><a href="index.php">Koti</a></li>
                        <li><a href="infoPage.php">Tietoa</a></li>
                    </ul>
                </div>

                <!-- Käyttäjätunnistus -->
                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki -->
                <div id="nav" class="three columns">
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

    </div>
</html>