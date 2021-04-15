<?php
    //Käyttäjän tila
    if($_SESSION['sloggedIn']=="yes"){
        //echo("<li>Käyttäjä: " .$_SESSION['suserName'] . "<br>");
        $url = $_SERVER["REQUEST_URI"]; 
        $pos = strrpos($url, "userAccount.php"); 

        if ($pos != false) {
            echo("<li class=\"nav__item active\"><a href=\"userAccount.php\">" . $_SESSION['suserName'] . ":n sivu</a></li><br />");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\">Uloskirjautuminen</a></li><br />");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"userAccount.php\">" . $_SESSION['suserName'] . ":n sivu</a></li><br />");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\">Uloskirjautuminen</a></li><br />");
        }
    }
    else {
        $url = $_SERVER["REQUEST_URI"]; 
        $pos1 = strrpos($url, "logInUser.php");
        $pos2 = strrpos($url, "createAccount.php");

        if ($pos1 != false) {
            echo("<li class=\"nav__item active\"><a href=\"logInUser.php\">Kirjaudu sisään</a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\">Rekisteröinti</a></li>");
        }
        else if ($pos2 != false) {
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\">Kirjaudu sisään</a></li>");
            echo("<li class=\"nav__item active\"><a href=\"createAccount.php\">Rekisteröinti</a></li>");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\">Kirjaudu sisään</a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\">Rekisteröinti</a></li>");
        }
    }
?>