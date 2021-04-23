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

    <!-- Rekisteröintilomake -->
    <div class="container top_content">
        <div class="one-half column">
            <?php
                include("forms/fcreateAccount.php");
            ?>
        </div>

        <div class="one-half column">
            <img class="form__banner" src="images/Toivu.png" alt="Toivu-logo">
        </div>
    </div>
    
    <?php
        //Lomakkeen submit painettu?
        if (isset($_POST['submitUser'])) {
            //***Tarkistetaan syötteet myös palvelimella
            if (strlen($_POST['givenUsername']) < 4) {
            $_SESSION['swarningInputCreate'] = "Puutteellinen käyttäjänimi (väh. 4 merkkiä)";
            }
            else if (!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['swarningInputCreate'] = "Virheellinen sähköposti";
            }
            else if (strlen($_POST['givenPassword']) < 8) {
            $_SESSION['swarningInputCreate'] = "Puutteellinen salasana (väh. 8 merkkiä)";
            }
            else if (!preg_match("#[0-9]+#", $_POST['givenPassword'])) {
            $_SESSION['swarningInputCreate'] = "Puutteellinen salasana (väh. 1 numero)";
            }
            else if (!preg_match("#[A-Z]+#", $_POST['givenPassword'])) {
            $_SESSION['swarningInputCreate'] = "Puutteellinen salasana (väh. 1 iso kirjain)";
            }
            else if (!preg_match("#[a-z]+#", $_POST['givenPassword'])) {
            $_SESSION['swarningInputCreate'] = "Puutteellinen salasana (väh. 1 pieni kirjain)";
            }
            else if ($_POST['givenPassword'] != $_POST['givenPasswordVerify']) {
            $_SESSION['swarningInputCreate'] = "Annettu salasana ja vahvistus eivät ole samat";
            }
            else {
                include("includes/imoveToDB.php");
            }
        }
    ?>

    <div class="container">
        <?php
            //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
            if (isset($_SESSION['swarningInputUpdate'])) {
                echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInputCreate']."</p>");
                unset($_SESSION['swarningInputCreate']);
            }
        ?>
    </div>

    <script src="js/collapse-menu.js"></script>
    <script src="js/datepicker.js"></script>

<?php
    include("includes/ifooter.php");
?>