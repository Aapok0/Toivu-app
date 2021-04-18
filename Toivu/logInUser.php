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

    <div class="container top-content">
        <div class="one-half column">
            <?php
                include("forms/flogInUser.php");
            ?>
        </div>

        <div class="one-half column">
            <img src="images/Toivu.png" alt="Toivu-logo">
        </div>
    </div>

    <?php
        //Lomakkeen submit painettu?
        if (isset($_POST['submitUser'])) {
            //***Tarkistetaan syötteet myös palvelimella
            if (!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['swarningInput'] = "Virheellinen sähköposti";
            }
            else {
                unset($_SESSION['swarningInput']);
            } 
            try {
                //Tiedot kannasta, hakuehto
                $data['email'] = $_POST['givenEmail'];
                $STH = $DBH->prepare("SELECT userID, userName, userPwd, userEmail FROM wsk21_toivu_user WHERE userEmail = :email;");
                $STH -> execute($data);
                $STH -> setFetchMode(PDO::FETCH_OBJ);
                $tulosOlio = $STH->fetch();
                //lomakkeelle annettu salasana + suola
                $givenPasswordAdded = $_POST['givenPassword'].$added;
      
                //Löytyikö email kannasta?
                if ($tulosOlio != NULL) {
                    //email löytyi
                    //var_dump($tulosOlio);
                    if (password_verify($givenPasswordAdded,$tulosOlio->userPwd)) {
                        $_SESSION['sloggedIn'] = "yes";
                        $_SESSION['suserName'] = $tulosOlio->userName;
                        $_SESSION['suserEmail'] = $tulosOlio->userEmail;
                        $_SESSION['suserID'] = $tulosOlio->userID;
                        //header("Location: index.php"); //Palataan pääsivulle kirjautuneena
                        header("Location: userAccount.php"); //Vie omalle sivulle
                    }
                    else {
                    $_SESSION['swarningInput'] = "Väärä salasana";
                    }
                }
                else {
                $_SESSION['swarningInput'] = "Väärä sähköposti";
                }
            } 
            catch (PDOException $e) {
                file_put_contents('log/DBErrors.txt', 'logInUser.php: '.$e -> getMessage()."\n", FILE_APPEND);
                $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
            }
        }
    ?>

    <?php
        //***Luovutetaanko ja palataan takaisin pääsivulle alkutilanteeseen
        //ilma  rekisteröintiä?
        if (isset($_POST['submitBack'])) {
            session_unset();
            session_destroy();
            header("Location: index.php");
        }
    ?>
    
    <div class="container">
        <?php
            //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
            if (isset($_SESSION['swarningInput'])) {
                echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInput']."</p>");
                unset($_SESSION['swarningInput']);
            }
        ?>
    </div>

    <script src="js/collapse-menu.js"></script>
    <script src="js/form_validation.js"></script>

<?php
    include("includes/ifooter.php");
?>