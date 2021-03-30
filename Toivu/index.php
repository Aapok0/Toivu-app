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

        <!-- Esittelyteksti -->
        <div class="container">
            <div class="row">
                <div class="twelve columns hero-text">
                    <h4>Toivu-hyvinvointisovellus</h4>
                    <p>Tärkeä töissä jaksamiseen ja työtehoon vaikuttava tekijä on stressi ja siitä palautuminen. Stressi on kokemus, jonka kaikki tunnistaa, ja omaa palautumista voi arvioida tunteen mukaan, mutta mitä jos nämä kokemukset voisi muuttaa objektiivisiksi arvioiksi?</p>
                </div>
            </div>

            <!-- Call-to-action-nappi rekisteröintiin -->
        </div>

        <div class="container">
            <div class="row">
                <div class="twelve columns">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

<?php
    include("includes/ifooter.php");
?>