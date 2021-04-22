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
                        <nav>
                            <button class="nav__toggle button-light" aria-expanded="false" type="button">
                                Päävalikko
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

        <!-- profiilinavigaatio -->
        <div class="container">
            <div class="row">
                <div class="twelve columns profile-header profile-header__wrapper">
                    <nav class="profile-header__end">
                        <button class="pro-nav__toggle button-light" aria-expanded="false" type="button">
                            Profiilivalikko
                        </button>
                        <ul class="pro-nav__wrapper no-bullets">
                            <?php
                                include("includes/inavProfile.php");
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container profile-page">
            <h2 class="text-center">Ohjeita sovelluksen käyttöön</h2>
        </div>

        <script src="js/collapse-menu.js"></script>
        <script src="js/form_validation.js"></script>

<?php
    include("includes/ifooter.php");
?>