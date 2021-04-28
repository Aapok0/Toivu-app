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

    <!-- Lomake, jolla kirjaudutaan sisään -->
    <div class="container top_content">
        <div class="row">
            <div class="one-half column">
                <?php
                    include("forms/flogInUser.php");
                ?>
            </div>

            <div class="one-half column">
                <img class="form__banner" src="images/Toivu.png" alt="Toivu-logo">
            </div>
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
                        $_SESSION['toivu_loggedIn'] = "yes";
                        $_SESSION['toivu_userName'] = $tulosOlio->userName;
                        $_SESSION['toivu_userEmail'] = $tulosOlio->userEmail;
                        $_SESSION['toivu_userID'] = $tulosOlio->userID;
                        echo("<script>location.href = 'userAccount.php';</script>");
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

<?php
    include("includes/ifooter.php");
?>