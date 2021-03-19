<?php
    //Käyttäjän tila
    if($_SESSION['sloggedIn']=="yes"){
        echo("<p>Käyttäjä: " .$_SESSION['suserName'] . "<br>");
        echo("<a href=\"userAccount.php\">Oma sivu</a><br>");
        echo("<a href=\"logOutUser.php\">Uloskirjautuminen</a></p>");
    }
    else {
?>
        <a id="user" href="logInUser.php">Kirjaudu sisään</a>
        <a id="user" href="createAccount.php">Rekisteröinti</a>
<?php
    }
?>