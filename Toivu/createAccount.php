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
                <li><a href="index.php">Koti</a></li>
                <li><a href="#">Tietoa</a></li>
            </ul>
        </div>

      </div>
    </nav>

    <!-- Rekisteröintilomake -->
    <div class="container">
      <div class="one-half column">
        <?php
          include("forms/fcreateAccount.php");
        ?>
      </div>
    </div>

    <?php
      //Lomakkeen submit painettu?
      if (isset($_POST['submitUser'])) {
        //***Tarkistetaan syötteet myös palvelimella
        if (strlen($_POST['givenUsername']) < 4) {
          $_SESSION['swarningInput'] = "Puutteellinen käyttäjänimi (väh. 4 merkkiä)";
        }
        else if (!filter_var($_POST['givenEmail'], FILTER_VALIDATE_EMAIL)) {
          $_SESSION['swarningInput'] = "Virheellinen sähköposti";
        }
        else if (strlen($_POST['givenPassword']) < 8) {
          $_SESSION['swarningInput'] = "Puutteellinen salasana (väh. 8 merkkiä)";
          $password = test_input($_POST["password"]);
          if (!preg_match("#[0-9]+#", $password)) { //Miten tarkistetaan erikoismerkkejä?
            $_SESSION['swarningInput'] = "Puutteellinen salasana (väh. 1 numero)";
          }
          else if (!preg_match("#[A-Z]+#", $password)) {
            $_SESSION['swarningInput'] = "Puutteellinen salasana (väh. 1 iso kirjain)";
          }
          else if (!preg_match("#[a-z]+#", $password)) {
            $_SESSION['swarningInput'] = "Puutteellinen salasana (väh. 1 pieni kirjain)";
          }
        }
        else if ($_POST['givenPassword'] != $_POST['givenPasswordVerify']) {
          $_SESSION['swarningInput'] = "Annettu salasana ja vahvistus eivät ole samat";
        }
        else if (!empty($_POST['givenHeight'])) {
          if (is_numeric($_POST['givenHeight'] != 1)) {
            $_SESSION['swarningInput'] = "Annettu pituus ei ole numero";
          }
          else {
            include("includes/imoveToDB.php");
          }
        }
        else if (empty($_POST['givenWeight'])) {
          if (is_numeric($_POST['givenWeight'] != 1)) {
            $_SESSION['swarningInput'] = "Annettu paino ei ole numero";
          }
          else {
            include("includes/imoveToDB.php");
          }
        }
        else if (empty($_POST['givenBday'])) {
          if (!strtotime($_POST['givenBday'])) {
            $_SESSION['swarningInput'] = "Annettu päivämäärä väärässä muodossa, anna muodossa YYYY-MM-DD";
          }
          else {
            include("includes/imoveToDB.php");
          }
        }
        else {
          include("includes/imoveToDB.php");
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
        }
      ?>
    </div>

    <?php
      include("includes/ifooter.php");
    ?>

  </div>
</html>