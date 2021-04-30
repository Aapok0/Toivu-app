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

        <!-- Päivityslomake -->
        <div class="container top_content">
            <div class="row">
                <div class="one-half column">
                    <?php
                        include("forms/fupdateAccount.php");
                    ?>
                </div>

                <!-- Logo lomakkeen vieressä -->
                <div class="one-half column">
                    <img src="images/Toivu.png" alt="Toivu-logo">
                </div>
            </div>
        </div>

        <!-- Lomakkeen syötteiden validointi ja läpi päästyä tietokantaan siirto -->
        <?php
            //Lomakkeen submit painettu? Kaikki syötteet erillisellä submit-napilla
            //***Tarkistetaan syötteet myös palvelimella

            //Käyttäjänimi
            if (isset($_POST['submitName'])) {
                if (strlen($_POST['givenUsername']) < 4) { //tarpeeksi merkkejä
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen käyttäjänimi (väh. 4 merkkiä)";
                }
                else {
                    include("includes/iupdateDB.php");
                }
            }

            //Email
            else if (isset($_POST['submitEmail'])) {
                //***Email ei saa olla käytetty aiemmin
                $sql = "SELECT COUNT(*) FROM wsk21_toivu_user where userEmail =  " . "'".$_POST['givenEmail']."'";
            
                $kysely = $DBH -> prepare($sql);
                $kysely -> execute();				
                $tulos = $kysely -> fetch();

                if ($tulos[0] != 0) { //email ei ole käytössä
                    $_SESSION['swarningInputUpdate'] = "Sähköposti on varattu";
                }
                else if (!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)) { //onko validi osoite?
                    $_SESSION['swarningInputUpdate'] = "Virheellinen sähköposti";
                }
                else {
                    include("includes/iupdateDB.php"); //validaatio ok? -> siirrytään laittamaan tietokantaan
                }
            }

            //Salasana
            else if (isset($_POST['submitPass'])) {
                if (strlen($_POST['givenPassword']) < 8) { //tarpeeksi merkkejä
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 8 merkkiä)";
                }
                else if (!preg_match("#[0-9]+#", $_POST['givenPassword'])) { //sisältää numeroita
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 numero)";
                }
                else if (!preg_match("#[A-Z]+#", $_POST['givenPassword'])) { //sisältää isoja kirjaimia
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 iso kirjain)";
                }
                else if (!preg_match("#[a-z]+#", $_POST['givenPassword'])) { //sisältää pieniä kirjaimia
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 pieni kirjain)";
                }
                else if ($_POST['givenPassword'] != $_POST['givenPasswordVerify']) { //salasanat täsmää
                    $_SESSION['swarningInputUpdate'] = "Annettu salasana ja vahvistus eivät ole samat";
                }
                else {
                    include("includes/iupdateDB.php"); //validaatio ok? -> siirrytään laittamaan tietokantaan
                }
            }

            //Pituus
            else if (isset($_POST['submitHeight'])) {
                include("includes/iupdateDB.php");
            }

            //Paino
            else if (isset($_POST['submitWeight'])) {
                include("includes/iupdateDB.php");
            }

            //Syntymäpäivä
            else if (isset($_POST['submitBday'])) {
                //onko päivämäärä valittu avautuvasta kalenterista ja onko se validi?
                //regex löydetty sivustolta https://www.sitepoint.com/community/t/php-regex-needed-for-dd-mm-yyyy-format/6945/5, alkuperäinen lähde https://regexlib.com/REDetails.aspx?regexp_id=409
                if (!preg_match('~^(((0[1-9]|[12]\\d|3[01])\\/(0[13578]|1[02])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|[12]\\d|30)\\/(0[13456789]|1[012])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|1\\d|2[0-8])\\/02\\/((19|[2-9]\\d)\\d{2}))|(29\\/02\\/((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~', $_POST['givenBday'])) {
                    $_SESSION['swarningInputUpdate'] = "Syntymäpäivä annettu väärässä muodossa. Valitse päivä avautuvasta kalenterista.";
                }
                else {
                    include("includes/iupdateDB.php"); //validaatio ok? -> siirrytään laittamaan tietokantaan
                }
            }

            //Sukupuoli
            else if (isset($_POST['submitSex'])) {
                include("includes/iupdateDB.php");
            }
        ?>

        <!-- Linkki takaisin asetuksiin -->
        <?php
            //***Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
            //ilman  rekisteröintiä?
            if (isset($_POST['submitBack'])) {
                echo("<script>location.href = 'userSettings.php';</script>");
            }
        ?>

        <!-- Virheviesti, jos lomake ei mene läpi serveripuolen validoinnista -->
        <div class="container">
            <?php
                //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
                if (isset($_SESSION['swarningInputUpdate'])) {
                    echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInputUpdate']."</p>");
                    unset($_SESSION['swarningInputUpdate']);
                }
            ?>
        </div>

        <!-- Skriptit alkaa -->
        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Toivu scripts -->
        <script src="js/collapse-menu.js"></script>
        <script src="js/datepicker.js"></script>
        <script src="js/confirmEmpty.js"></script>
        <!-- Skriptit loppuu -->

<?php
    include("includes/ifooter.php");
?>