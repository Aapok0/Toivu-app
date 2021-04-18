<?php
    //Käyttäjän tila
    if($_SESSION['sloggedIn']=="yes"){
        //echo("<li>Käyttäjä: " .$_SESSION['suserName'] . "<br>");
        $url = $_SERVER["REQUEST_URI"]; 
        $pos01 = strrpos($url, "userAccount.php");
        $pos02 = strrpos($url, "notifications.php");
        $pos03 = strrpos($url, "userSettings.php");

        if ($pos01 != false) {
            echo("<li class=\"nav__item active\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['suserName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"notifications.php\"><img class=\"nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"userSettings.php\"><img class=\"nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
        else if ($pos02 != false) {
            echo("<li class=\"nav__item\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['suserName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item active\"><a href=\"notifications.php\"><img class=\"nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"userSettings.php\"><img class=\"nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
        else if ($pos03 != false) {
            echo("<li class=\"nav__item\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['suserName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"notifications.php\"><img class=\"nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"nav__item active\"><a href=\"userSettings.php\"><img class=\"nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"userAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>" . $_SESSION['suserName'] . ":n sivu</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"notifications.php\"><img class=\"nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"userSettings.php\"><img class=\"nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"logOutUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-out_298869.png\" alt=\"Profile\"><span>Kirjaudu ulos</span></a></li>");
        }
    }
    else {
        $url = $_SERVER["REQUEST_URI"]; 
        $pos1 = strrpos($url, "logInUser.php");
        $pos2 = strrpos($url, "createAccount.php");

        if ($pos1 != false) {
            echo("<li class=\"nav__item active\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</a></span></li>");
        }
        else if ($pos2 != false) {
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item active\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</a></span></li>");
        }
        else {
            echo("<li class=\"nav__item\"><a href=\"logInUser.php\"><img class=\"nav-icon\" src=\"images/iconfinder_sign-in_298868.png\" alt=\"Profile\"><span>Kirjaudu sisään</span></a></li>");
            echo("<li class=\"nav__item\"><a href=\"createAccount.php\"><img class=\"nav-icon\" src=\"images/iconfinder_add_user_309049.png\" alt=\"Profile\"><span>Rekisteröinti</a></span></li>");
        }
    }
?>