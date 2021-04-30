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
                                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki sekä profiilinavigaatio -->
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

        <!-- Esittelyteksti alkaa -->
        <div class="container">
            <div class="row">
                <div class="twelve columns top_content">
                    <h1 class="text-center">Toivu</h1>
                    <h3 class="text-center">Hyvinvointisovellus</h3>
                    <!-- Nopea myyntiteksti -->
                    <p class="text-center">Tärkeä töissä jaksamiseen ja työtehoon vaikuttava tekijä on stressi ja siitä palautuminen. Stressi on kokemus, jonka kaikki tunnistaa, ja omaa palautumista voi arvioida tunteen mukaan, mutta mitä jos nämä kokemukset voisi muuttaa objektiivisiksi arvioiksi?</p>
                    
                    <!-- Iso logo keskellä etusivua -->
                    <img class="logo__banner" src="images/Toivu.png" alt="Toivu-logo">
                    
                    <!-- Käyttötarkoitus -->
                    <h3 class="text-center">Sovelluksen käyttötarkoitus</h3>
                    <p>Sovelluksen käyttötarkoitus on stressin seuranta ja siitä palautuminen, se luokitellaan siis hyvinvointisovellukseksi. Sovellusta ei ole tarkoitettu diagnosoimaan mitään stressistä mahdollisesti aiheutuvia sairauksia, mutta sen keräämistä tiedoista ja analyyseistä saattaa olla hyötyä lääkärille diagnoosia tehtäessä.</p>
                    <p>Stressiarvojen mittaaminen ja näiden mittausten analysointi ja esittely graafeissa vaatii ulkoisen sykevälivaihteluarvoa mittaavan laitteen. Sovelluksen muut ominaisuudet toimivat ilman ulkoisia laitteita. Sovelluksesta löytyy analyysien ja graafien lisäksi myös kalenteri hyvinvoinnin seurantaa varten, sekä yleistä tietoa stressistä, sen vaikutuksista ihmiseen ja yleiseen hyvinvointiin, sekä keinoja siitä palautumiseen. Lisätietoa sovelluksen ominaisuuksista löytyy "Tietoa" välilehdeltä.<p>
                </div>
            </div>

            <!-- Kuvia sovelluksen toiminnasta -->
            <div class="row">
                <div class="one-half column">
                    <p class="img-text">Sovellus tekee sykevälimittausarvoista analyyseja ja antaa tietoa sinun stressistä ja siitä palautumisesta.</p>
                    <img class="front-img" src="images/example1.png" alt="Analyysi">
                </div>

                <div class="one-half column">
                    <p class="img-text">Mittaamisen ohella voi seurata omaa oloa kalenteriin tehtävillä muistiinpanoilla ja vertailla omissa tuloksissa tapahtuvia muutoksia niihin.</p>
                    <img class="front-img" src="images/example2.png" alt="Kalenteri">
                </div>
            </div>
        </div>
        <!-- Esittelyteksti loppuu -->

        <!-- Skriptit alkaa -->
        <!-- Toivu scripts -->
        <script src="js/collapse-menu.js"></script>
        <script src="js/confirmEmpty.js"></script>
        <!-- Skriptit loppuu -->

<?php
    include("includes/ifooter.php");
?>