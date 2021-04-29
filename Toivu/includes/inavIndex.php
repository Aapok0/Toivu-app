<?php
    //Tarkistetaan, onko käyttäjä kirjautunut, ja millä sivulla käyttäjä on ja esitetään se navigaatiossa

    //Käyttäjän tila
    if($_SESSION['toivu_loggedIn']=="yes"){
        //echo("<li>Käyttäjä: " .$_SESSION['toivu_userName'] . "<br>");
        $url = $_SERVER["REQUEST_URI"]; 
        $pos01 = strrpos($url, "userAccount.php");
        $pos02 = strrpos($url, "analyses.php");
        $pos03 = strrpos($url, "calendar.php");
        $pos04 = strrpos($url, "notifications.php");
        $pos05 = strrpos($url, "userSettings.php");
        $pos06 = strrpos($url, "instructions.php");

        if (($pos01 != false) || ($pos02 != false) || ($pos03 != false) || ($pos04 != false) || ($pos05 != false) || ($pos06 != false)) { //ollaan profiilisivuilla
            echo("<li class=\"nav__item active\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['toivu_userName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['toivu_userName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
    }
    else {
        $url = $_SERVER["REQUEST_URI"]; 
        $pos1 = strrpos($url, "logInUser.php");
        $pos2 = strrpos($url, "createAccount.php");
        $pos3 = strrpos($url, "returnPassword.php");

        if ($pos1 != false) { //ollaan kirjautumissivulla
            echo("<li class=\"nav__item active\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</span></a></li>");
        }
        else if ($pos2 != false) { //ollaan rekisteröintisivulla
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item active\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</span></a></li>");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</span></a></li>");
        }
    }
?>