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
                        <nav>
                            <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
                            <button class="nav__toggle button-light" aria-expanded="false" type="button">
                                Päävalikko
                            </button>
                            <!-- Navigaatiolinkit alkaa -->
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
                            <!-- Navigaatiolinkit loppuu -->
                        </nav>
                    </div>
                    <!-- Navigaation oikea laita loppuu -->
                </header>
            </div>
        </div>
        <!-- Uusi päänavigaatio loppuu -->

        <!-- Profiilinavigaatio alkaa -->
        <!-- Näkyy vain kirjautuneille -->
        <div class="container">
            <div class="row">
                <div class="twelve columns profile-header profile-header__wrapper">
                    <nav class="profile-header__end">
                        <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
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
        <!-- Profiilinavigaatio loppuu -->

        <!-- Ohjeita ja neuvoja siihen miten sovellusta käytetään ja tulkitaan --> 
        <div class="container profile-page">
            <div class="row">
                <div class="twelve columns top_content">
                        <h2 class="text-center">Ohjeita sovelluksen käyttöön</h2>
                            <div class="advice-column">
                                <h4 class="text-center">Mittaa sykevälivaihteluarvosi</h4>
                                <img class="front-img" src="images/Polar_mittari.jpg" alt="Kuva mittarista">
                                <p class="advice">  1. Mittaukseen voit käyttää mitä tahansa sykevälivaihteluarvoa mittaavaa laitetta.<br>
                                                    <br>
                                                    2. Noudata mittalaitteen mukana tulevia ohjeita mittauksen suorittamiseksi.</p>
                            </div>
                            <div class="advice-column">
                                <h4 class="text-center">Tarkastele mittaustuloksia graafeista</h4>
                                <img class="front-img" src="images/example1.png" alt="Kuva graafista">
                                <p class="advice">  1. Graafeista näet sykevaihtelun, leposykkeen, sekä levollisuusanalyysin.<br>
                                                    <br>
                                                    2. Kahdessa ensimmäisessä graafissa on mahdollista muuttaa tietojen aikaväliä vaaka-akselilla ja mitattuja tietoja pystyakselilla. Tämän voit tehdä siirtämällä graafin vieressä ja alla olevia harmaita palloja.<br>
                                                    <br>
                                                    3. Kaikkien graafien tiedot on mahdollista nähdä tarkemmin, jos siirrät kursorin graafin päälle.<br>
                                                    <br>
                                                    4 Levollisuusanalyysigraafissa esitetyt asiat, eli pNN 50 ja Readiness, tarkoittavat:<br>
                                                    <br>
                                                     pNN 50: Mittaa, kuinka monta prosenttia sydämen peräkkäisistä lyönneistä eroaa toisistaan ainakin 50ms. Kuten normaalissakin sykevälivaihtelussa, korkea arvo tarkoittaa parempaa mittaustulosta. Tiivistettynä se on siis vaihtoehtoinen mittaustapa ihmisen sykevälivaihtelulle.<br>
                                                    <br> 
                                                     Readiness: Tarkoittaa leposykevälien keskimääräistä vaihtelua. Koska tämä arvo mittaa leposykettä, paras aika tehdä readiness mittaus on aamulla juuri heräämisen jälkeen. Tässäkin korkeampi arvo tarkoittaa terveellisempää mittaustulosta.
                                </p>
                            </div>

                            <div class="advice-column">
                                <h4 class="text-center">Kirjaa päivittäiset tuntemuksesi päiväkirjaan</h4>
                                <img class="front-img" src="images/example2.png" alt="Kuva päiväkirjasta">
                                <p class="advice">  1. Kalenteriin voit kirjata päivittäisen olotilasi klikkaamalla sitä päivää kalenterissa, johon haluat merkitä olotilasi.<br>
                                                    <br>
                                                    2. klikkauksen jälkeen sovellus tarjoaa sinulle tekstilaatikon, johon voit kirjoittaa. Kirjoittamisen jälkeen sovellus kysyy päivittäistä olotilaasi, jonka jälkeen se tallentuu kyseisen päivän kohdalle.<br>
                                                    <br>
                                                    3. Voit myös poistaa jonkin merkinnän klikkaamalla sitä ja varmistamalla poiston sivun yläosaan ilmestyvästä ilmoituksesta.<br>
                                                    <br>
                                                    4. Kalenterissa on myös mahdollista merkitä sama tapahtuma monelle päivälle klikkaamalla yhtä päivää ja siirtämällä sitten pohjaan painetun kursorin muiden päivien kohdalle.
                                </p>
                            </div>
                </div>
            </div>
        </div>

        <!-- Käyttöohjeet loppuu -->

        <!-- Skriptit alkaa -->
        <!-- Toivu scripts -->
        <script src="js/collapse-menu.js"></script>
        <script src="js/confirmEmpty.js"></script>
        <!-- Skriptit loppuu -->

<?php
    include("includes/ifooter.php");
?>