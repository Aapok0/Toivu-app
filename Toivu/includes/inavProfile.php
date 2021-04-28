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
        $pos07 = strrpos($url, "updateAccount.php");

        if ($pos01 != false) { //ollaan profiilin etusivulla
            echo("<li class=\"pro-nav__item active\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos02 != false) { //ollaan analyysisivulla
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos03 != false) { //ollaan kalenterisivulla
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos04 != false) { //ollaan viestisivulla
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if (($pos05 != false) || ($pos07 != false)) { //ollaan asetussivulla tai tietojenpäivityssivulla
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos06 != false) { //ollaan ohjesivulla
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['toivu_unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
    }
?>