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
                                <li class="nav__item">
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

        <!-- Profiilisivun otsikko ja tervehdys -->
        <div class="container">
            <div class="twelve columns">
                <h1>
                    <?php
                        echo($_SESSION['suserName'] . ":n oma sivu");
                    ?>
                </h1>
            </div>

            <?php
                include("includes/readiness.php");
            ?>

            <!-- Graafit -->
            <div class="twelve columns">
                <h3>Testigraafi 1</h3>
                <div id="graph1"></div>
            </div>

            <div class="twelve columns">
                <h3>Testigraafi 2</h3>
                <div id="graph2"></div>
            </div>

            <!-- Kalenteri -->
            <div class="twelve columns">
                <h3>Testikalenteri</h3>
                <div id="calendar"></div>
            </div>
        </div>

        <script src="js/collapse-menu.js"></script>

<?php
    include("includes/ifooter.php");
?>