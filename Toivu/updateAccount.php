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
                            <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
                            <button class="nav__toggle" aria-expanded="false" type="button">
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

        <!-- Päivityslomake -->
        <div class="container top_content">
            <div class="row">
                <div class="one-half column">
                    <?php
                        include("forms/fupdateAccount.php");
                    ?>
                </div>

                <div class="one-half column">
                    <img src="images/Toivu.png" alt="Toivu-logo">
                </div>
            </div>
        </div>

        <?php
            //Lomakkeen submit painettu?
            //***Tarkistetaan syötteet myös palvelimella
            if (isset($_POST['submitName'])) {
                if (strlen($_POST['givenUsername']) < 4) {
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen käyttäjänimi (väh. 4 merkkiä)";
                }
                else {
                    include("includes/iupdateDB.php");
                }
            }
            else if (isset($_POST['submitEmail'])) {
                //***Email ei saa olla käytetty aiemmin
                $sql = "SELECT COUNT(*) FROM wsk21_toivu_user where userEmail =  " . "'".$_POST['givenEmail']."'";
            
                $kysely = $DBH -> prepare($sql);
                $kysely -> execute();				
                $tulos = $kysely -> fetch();

                if ($tulos[0] != 0) { //email ei ole käytössä
                    $_SESSION['swarningInputUpdate'] = "Sähköposti on varattu";
                }
                else if (!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['swarningInputUpdate'] = "Virheellinen sähköposti";
                }
                else {
                    include("includes/iupdateDB.php");
                }
            }
            else if (isset($_POST['submitPass'])) {
                if (strlen($_POST['givenPassword']) < 8) {
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 8 merkkiä)";
                }
                else if (!preg_match("#[0-9]+#", $_POST['givenPassword'])) {
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 numero)";
                }
                else if (!preg_match("#[A-Z]+#", $_POST['givenPassword'])) {
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 iso kirjain)";
                }
                else if (!preg_match("#[a-z]+#", $_POST['givenPassword'])) {
                    $_SESSION['swarningInputUpdate'] = "Puutteellinen salasana (väh. 1 pieni kirjain)";
                }
                else if ($_POST['givenPassword'] != $_POST['givenPasswordVerify']) {
                    $_SESSION['swarningInputUpdate'] = "Annettu salasana ja vahvistus eivät ole samat";
                }
                else {
                    include("includes/iupdateDB.php");
                }
            }
            else if (isset($_POST['submitHeight'])) {
                include("includes/iupdateDB.php");
            }
            else if (isset($_POST['submitWeight'])) {
                include("includes/iupdateDB.php");
            }
            else if (isset($_POST['submitBday'])) {
                //regex löydetty sivustolta https://www.sitepoint.com/community/t/php-regex-needed-for-dd-mm-yyyy-format/6945/5, alkuperäinen lähde https://regexlib.com/REDetails.aspx?regexp_id=409
                if (!preg_match('~^(((0[1-9]|[12]\\d|3[01])\\/(0[13578]|1[02])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|[12]\\d|30)\\/(0[13456789]|1[012])\\/((19|[2-9]\\d)\\d{2}))|((0[1-9]|1\\d|2[0-8])\\/02\\/((19|[2-9]\\d)\\d{2}))|(29\\/02\\/((1[6-9]|[2-9]\\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$~', $_POST['givenBday'])) {
                    var_dump("124");
                    $_SESSION['swarningInputUpdate'] = "Syntymäpäivä annettu väärässä muodossa. Valitse päivä avautuvasta kalenterista.";
                }
                else {
                    include("includes/iupdateDB.php");
                }
            }
            else if (isset($_POST['submitSex'])) {
                include("includes/iupdateDB.php");
            }
        ?>

        <?php
            //***Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
            //ilman  rekisteröintiä?
            if (isset($_POST['submitBack'])) {
                session_unset();
                session_destroy();
                echo("<script>location.href = 'userSettings.php';</script>");
            }
        ?>

        <div class="container">
            <?php
                //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
                if (isset($_SESSION['swarningInputUpdate'])) {
                    echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInputUpdate']."</p>");
                    unset($_SESSION['swarningInputUpdate']);
                }
            ?>
        </div>

        <script src="js/collapse-menu.js"></script>
        <script src="js/datepicker.js"></script>

<?php
    include("includes/ifooter.php");
?>