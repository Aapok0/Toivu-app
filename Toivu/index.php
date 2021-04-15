<?php
    include("includes/iheader.php");
?>

    <div class="page-container">

        <!-- Uusi päänavigaatio -->
        <div class="header-background">
            <div class="container">
                <header class="site-header site-header__wrapper">
                    <div class="site-header__start">
                        <!-- Logo vasempaan ylälaitaan -->
                        <div id="logo">
                            <a href="index.php">
                                <img src="images/Toivu-logo_white-regular.png" alt="Toivu-logo">
                            </a>
                        </div>
                    </div>

                    <div class="site-header__end">
                        <nav class="nav">
                            <button class="nav__toggle" aria-expanded="false" type="button">
                                Menu
                            </button>
                            <ul class="nav__wrapper no-bullets">
                                <li class="nav__item active">
                                    <a href="index.php">Koti</a>
                                </li>
                                <li class="nav__item">
                                    <a href="infoPage.php">Tietoa</a>
                                </li>
                                <!-- Käyttäjätunnistus -->
                                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki -->
                                <?php
                                    include("includes/inavIndex.php");
                                ?>
                            </ul>
                        </nav>
                    </div>        
                </header>
            </div>
        </div>   

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
                    <h4>Testikalenteri</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>

        <script src="js/collapse-menu.js"></script>
        
<?php
    include("includes/ifooter.php");
?>