<?php
    //Käyttäjän tila
    if($_SESSION['sloggedIn']=="yes"){
        echo("<p>Käyttäjä: " .$_SESSION['suserName'] . "<br>");
        echo("<a href=\"userAccount.php\">Oma sivu</a><br>");
        echo("<a href=\"logOutUser.php\">Uloskirjautuminen</a></p>");
    }
    else {
?>
        <a class="user" href="logInUser.php">Kirjaudu sisään</a>
        <a class="user" href="createAccount.php">Rekisteröinti</a>
<?php
    }
?>