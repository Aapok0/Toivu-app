<?php
  include("includes/iheader.php");
?>

  <div id="page-container">

    <!-- Päänavigaatio -->
    <nav>
      <div id="nav-bar" class="container">

        <!-- Logo vasempaan ylälaitaan -->
        <div class="two columns">
            <h1>Logo</h1>
        </div>

        <div id="nav" class="seven columns">
            <ul>
                <li>
                    <a href="index.php">Koti</a>
                </li>
                <li>
                    <a href="#">Tietoa</a>
                </li>
            </ul>
        </div>

      </div>
    </nav>

    <div class="container">
      <div class="one-half column">
        <?php
          include("forms/flogInUser.php");
        ?>
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
          try {
            //Tiedot kannasta, hakuehto
            $data['email'] = $_POST['givenEmail'];
            $STH = $DBH->prepare("SELECT userName, userPwd, userEmail FROM wsk21_toivu_user WHERE userEmail = :email;");
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

    <?php
      //***Näytetäänkö lomakesyötteen aiheuttama varoitus?
      if (isset($_SESSION['swarningInput'])) {
        echo("<p class=\"warning\">Virheellinen syöte: ". $_SESSION['swarningInput']."</p>");
      }
    ?>

    <?php
      include("includes/ifooter.php");
    ?>

  </div>
</html>