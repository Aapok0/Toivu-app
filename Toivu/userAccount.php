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
                            <button class="nav__toggle button-light" aria-expanded="false" type="button">
                                Menu
                            </button>
                            <ul class="nav__wrapper no-bullets">
                                <li class="nav__item">
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

        <!-- Profiilisivun otsikko ja tervehdys -->
        <div class="container profile-page">
            <div class="twelve columns">
                <h1>
                    <?php
                        echo("<h1 class=\"text-center first-heading\">Tervetuloa takaisin " . $_SESSION['suserName'] . "!</h1>");
                    ?>
                </h1>
            </div>

            <!-- Graafit -->
            <?php
                include("includes/igraph1.php");
                include("includes/igraph2.php");
                include("includes/igraph3.php");
            ?>

            <!-- Kalenteri -->
            <div class="twelve columns">
                <h2 class="text-center">Kalenteri</h2>
                <p>Kalenteriin voi lisätä tapahtumia joko painamalla yksittäistä päivää tai ajankohtaa tai pitämällä pohjassa hiiren vasenta nappia ja vetämällä halutun päivien määrän tai aika-alueen. Sovellus kysyy tämän jälkeen tapahtuman selityksen ja arvion sen hetkisestä olosta asteikolla 1-5. Tapahtumia voi siirtää eri kohtaan pitämällä pohjassa tapahtumaa ja vetämällä haluttuun uuteen paikkaan sekä ne voi poistaa painamalla niitä kerran. Sovellus kysyy varmistukseksi haluatko varmasti poistaa kyseisen tapahtuman.</p>
                <div id="calendar"></div>
            </div>

            <?php
                include("includes/ireadiness.php");
            ?>
        </div>

        <script src="js/collapse-menu.js"></script>

<?php
    include("includes/ifooter.php");
?>