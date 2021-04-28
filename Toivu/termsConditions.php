<?php
    session_start();
    include("includes/iheader.php");
?>

    <!-- Sivun säiliö alkaa -->
    <div class="page-container">

        <!-- Uusi päänavigaatio alkaa -->
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

                    <!-- Navigaation oikea laita alkaa -->
                    <div class="site-header__end">
                        <nav class="nav">
                            <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
                            <button class="nav__toggle" aria-expanded="false" type="button">
                                Menu
                            </button>
                            <!-- Navigaatiolinkit alkaa -->
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
                            <!-- Navigaatiolinkit loppuu -->
                        </nav>
                    </div>
                    <!-- Navigaation oikea laita loppuu -->
                </header>
            </div>
        </div>
        <!-- Uusi päänavigaatio loppuu -->

        <!-- Suurinpiirtein hahmoteltuna, mitä käyttöehdoissa voisi hypoteettisesti olla. Ei keskitytä liikaa tähän. -->
        <div class="container">
            <div class="row">
                <div class="twelve columns top_content">
                    <h1 class="text-center">Käyttöehdot</h1>
                    <p>Tämä on vain hahmotelma mahdollisista käyttöehdoista tälle proof of concept tuotteelle.</p>
                    <h3>1. Yleistä palvelun käytöstä</h3>
                    <h3>2. Käyttöoikeus ja käyttäjätiedot</h3>
                    <h3>3. Palvelun tietosuoja</h3>
                    <h3>4. Palvelun toimittaminen</h3>
                    <h3>5. Palvelun sisältö, immateriaalioikeudet ja ylläpito</h3>
                    <h3>6. Käyttöehtojen voimassolo sekä muutokset palvelussa</h3>
                    <h3>7. Henkilötietojen käsittely</h3>
                    <h3>8. Muut ehdot</h3>
                    <h3>9. Sovellettava laki ja riidanratkaisu</h3>
                    <h3>10. Yhteystiedot</h3>
                </div>
            </div>
        </div>

        <script src="js/collapse-menu.js"></script>

<?php
    include("includes/ifooter.php");
?>