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

        <!-- Lomake, jolla palautetaan salasana -->
        <div class="container top_content">
            <div class="row">
                <div class="one-half column">
                    <?php
                        include("forms/freturnPassword.php");
                    ?>
                </div>

                <!-- Logo lomakkeen vieressä -->
                <div class="one-half column">
                    <img class="form__banner" src="images/Toivu.png" alt="Toivu-logo">
                </div>
            </div>
        </div>

        <!-- Lomakkeen syötteen validointi ja läpi päästyä sähköpostin lähetys -->
        <?php
            //Funktio, joka luo uuden salasanan
            function newPassword() {
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ12345678901234567890';
                $password = array();
                $charLength = strlen($characters) - 1;
                for ($i = 0; $i < 12; $i++) {
                    $c = rand(0, $charLength);
                    $password[] = $characters[$c];
                }
                return implode($password);
            }

            //Lomakkeen submit painettu?
            if (isset($_POST['submitPass'])) {
                //***Tarkistetaan syötteet myös palvelimella

                //Tiedot kannasta, hakuehto
                $data['email'] = $_POST['givenEmail'];
                $STH = $DBH -> prepare("SELECT userEmail FROM wsk21_toivu_user WHERE userEmail = :email;");
                $STH -> execute($data);
                $STH -> setFetchMode(PDO::FETCH_OBJ);
                $tulosOlio = $STH->fetch();
    
                //Löytyikö email kannasta?
                if ($tulosOlio != NULL) {
                    //Luodaan uusi salasana
                    $newpass = newPassword();
                    //Suolataan uutta salasanaa
                    $newpassAdded = password_hash($newpass.$added, PASSWORD_BCRYPT);

                    //Päivitetään salasana tietokantaan
                    $sql = "UPDATE wsk21_toivu_user SET userPwd = :newpass WHERE userEmail = :email;";
                    $stmt = $DBH -> prepare($sql);
                    $stmt -> execute(array(
                        'newpass' => $newpassAdded,
                        'email' => $_POST['givenEmail']
                    ));

                    //Lähetetään uusi salasana sähköpostilla käyttäjälle
                    $recipient = $_POST['givenEmail'];
                    $subject = "Uusi salasanasi Toivu-sovellukseen";
                    $sender = "Toivu";
                    $senderEmail = "noreply@toivu.fi";
                    $message = "Hei,\n\ntässä uusi salasanasi: $newpass\n\nja muista heti kirjauduttuasi vaihtaa salasana uuteen sovelluksen asetuksista.";

                    $mailBody = "Nimi: $sender\nEmail: $senderEmail\n\n$message"; //Luodaan sähköpostin viesti

                    mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>"); //Lähetetään syötteiden mukaan
        
                    echo("<script>location.href = 'logInUser.php';</script>"); //Palataan sovellukseen
                }
            }
        ?>

        <!-- Virheviesti, jos lomake ei mene läpi serveripuolen validoinnista -->
        <div class="container">
            <?php
                //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
                if (isset($_SESSION['swarningInput'])) {
                    echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInput']."</p>");
                    unset($_SESSION['swarningInput']);
                }
            ?>
        </div>

        <!-- Skriptit alkaa -->
        <!-- Toivu scripts -->
        <script src="js/collapse-menu.js"></script>
        <script src="js/confirmEmpty.js"></script>
        <!-- Skriptit loppuu -->

<?php
    include("includes/ifooter.php");
?>