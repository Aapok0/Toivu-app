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

        <!-- Profiilisivun otsikko ja tervehdys -->
        <div class="container profile-page">
            <div class="row">
                <div class="twelve columns">
                    <?php
                        echo("<h1 class=\"text-center first-heading\">Tervetuloa takaisin " . $_SESSION['toivu_userName'] . "!</h1>");
                    ?>
                </div>
            </div>

            <!-- Kolumnit alkaa -->
            <!-- Ehdotuksia ja neuvoja palautumiseen. Optimi tilanteessa reagoisi käyttäjän mittauksiin ja esim. kalenteri-tageihin. -->
            <div class="row">
                <!-- Ensimmäinen kolumni alkaa -->
                <h3 class="text-center">Apua palautumiseen ja stressinhallintaan</h3>
                <div class="one-half column">
                    <div class="advice-column">
                        <h4 class="text-center">Hengitysharjoitukset</h4>
                        <img class="front-img" src="images/nose-breathing2.jpg" alt="Nenähengitys">
                        <p class="advice">Oikein tehdyllä hengitysharjoituksella on rentouttava vaikutus. Hengityksessä käytetään useita eri hengityslihaksia, joista pallea on tehokkain. Stressaantuneena pallean 
                        käyttö hengityksessä kuitenkin vähenee ja apuhengityslihaksien osus kasvaa. Tämä tekee hengityksestä vaikeampaa ja voi johtaa ahdistuksen tunteeseen. Palleahengityksessä pyritään käyttämään 
                        hengityslihaksena palleaa apuhengityslihaksien sijaan. Palleahengitystä voi tehdä joko seisten, istuen tai selinmakuulta. Kiinnitä huomiota hengitykseen. Sisäänhengitys lähtee syvältä palleasta 
                        ja keuhkot täytetään ilmalla alas asti. Oikean hengitystekniikan myötä muut lihasryhmät rentoutuvat ja rauhallisuuden tunne lisääntyy lähes välittömästi.
                        <br><br>Lähde: www.mielenterveystalo.fi
                        </p>
                    </div>

                    <div class="advice-column">
                        <h4 class="text-center">Apua nukahtamiseen</h4>
                        <img class="front-img" src="images/sleep-problems.jpg" alt="Uniongelmat">
                        <p class="advice">Unettomuuteen voi olla apuna elämäntapojen, rutiinien ja ajatusmallien muuttaminen. Tapojen muuttaminen voi olla vaikeaa ja vaatia paljon harjoittelua. Epäsäännöllisessä vuorotyössä 
                        itselle sopivan unirytmin rakentaminen voi olla haasteellista ja vaatia erityistä huomioimista. Unettomuuden hoidossa huomioitavia seikkoja ovat muun muassa elämäntavat, liikunta, ravinto, iltarutiinit 
                        ja nukkumisympäristö. Ennen nukkumaanmenoa on hyvä rentoutua. Rentoutumistapoja voivat olla esimerkiksi hengitysharjoitukset tai lihasrentoutukset.
                        <br><br>Lähde: www.mielenterveystalo.fi
                        </p>
                    </div>
                </div>
                <!-- Ensimmäinen kolumni loppuu -->

                <!-- Toinen kolumni alkaa -->
                <div class="six columns no-margin">
                    <div class="advice-column">
                        <h4 class="text-center">Lähde liikkeelle!</h4>
                        <img class="front-img" src="images/people-walking-dog-.jpg" alt="Ulkona kävely">
                        <p class="advice">Liikunta on yksi hyvinvoinnin perustoista. Liikunta auttaa ylläpitämään lihaksistoa ja luustoa sekä laskee verenpainetta. Liikunnalla voidaan purkaa vaikeita tunteita ja vähentää stressiä. 
                        Säännöllinen liikunta on myös hyvä keino ehkäistä masennusta. Liikunnan seurauksena erittyy mielihyvän tuntemuksesta vastaavia kehon hormoneja. Liikunnalla voidaan myös parantaa itseluottamusta ja itsetuntoa. 
                        Liikunta on näin ollen erittäin hyvä keino rentoutumiseen ja palautumiseen osana arkea. Muista, että liikunnan ei aina tarvitse olla fyysisesti raskasta - esimerkiksi kävely on hyvä liikunnan muoto, jonka voi 
                        lisätä arkeen hyötyliikuntana. 
                        <br><br>Lähde: www.mielenterveystalo.fi
                        </p>
                    </div>

                    <div class="advice-column">
                        <h4 class="text-center">Miten tauottaa työpäivää?</h4>
                        <img class="front-img" src="images/hammock-break.jpg" alt="Tauko">
                        <p class="advice">Taukojen pitäminen työpäivän aikana on tärkeä osa töissä jaksamista. Tauot pienentävät terveydelle haitallista kehon rasitusta ja kokonaiskuormitusta. Tauot lisäävät myös työtehokkuutta. Tauon 
                        aikana kannattaa harjoittaa taukoliikuntaa. Taukoliikunnassa voit verrytellä työpäivän aikana väsyviä lihaksia, jotta lihakset kestävät paremmin rasitusta jäljellä olevan työpäivän aikana. Venyttelyn ja lihasten 
                        herättelyn aikaansaama verenkierto lihaksissa voivat myös olla apuna väsymyksen tunteen ehkäisemiseksi. Taukoliikuntaa olisi hyvä tehdä ainakin 2-3 kertaa työpäivän aikana. 
                        <br><br>Lähde: www.työkykypassi.fi
                        </p>
                    </div>
                </div>
                <!-- Toinen kolumni loppuu -->
            </div>
        </div>
        <!-- Kolumnit loppuu -->

        <!-- Skriptit alkaa -->
        <!-- Toivu scripts -->
        <script src="js/collapse-menu.js"></script>
        <!-- Skriptit loppuu -->

<?php
    include("includes/ifooter.php");
?>