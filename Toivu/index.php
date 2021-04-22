<?php
    session_start();
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
                                <img src="images/Toivu2.png" alt="Toivu-logo">
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
                                    <a href="index.php">
                                        <img class="nav-icon" src="images/iconfinder_home_1608930.png" alt="Home">
                                        <span>Koti</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="infoPage.php">
                                        <img class="nav-icon" src="images/iconfinder_ic_info_48px_352431.png" alt="Info">
                                        <span>Tietoa</span>
                                    </a>
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
                <div class="twelve columns top_content">
                    <h1 class="text-center">Toivu</h1>
                    <h3 class="text-center">Hyvinvointisovellus</h3>
                    <img class="logo__banner" src="images/Toivu.png" alt="Toivu-logo">
                    <p>Tärkeä töissä jaksamiseen ja työtehoon vaikuttava tekijä on stressi ja siitä palautuminen. Stressi on kokemus, jonka kaikki tunnistaa, ja omaa palautumista voi arvioida tunteen mukaan, mutta mitä jos nämä kokemukset voisi muuttaa objektiivisiksi arvioiksi?</p>
                </div>
            </div>

            <!-- Call-to-action-nappi rekisteröintiin -->
        </div>

        <script src="js/collapse-menu.js"></script>
        <script src="js/form_validation.js"></script>

<?php
    include("includes/ifooter.php");
?>