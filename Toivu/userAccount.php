<?php
  include("includes/iheader.php");
?>

    <div id="page-container">

        <!-- Päänavigaatio -->
        <nav>
            <div id="nav-bar" class="container">

                <!-- Logo vasempaan ylälaitaan -->
                <div class="two columns">
                    <h1>Logo</h1>
                </div>

                <div id="nav" class="seven columns">
                    <ul>
                        <li><a href="index.php">Koti</a></li>
                        <li><a href="#">Tietoa</a></li>
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

        <?php
        include("includes/ifooter.php");
        ?>

    </div>
</html>