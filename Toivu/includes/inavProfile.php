<?php
    //Käyttäjän tila
    if($_SESSION['sloggedIn']=="yes"){
        //echo("<li>Käyttäjä: " .$_SESSION['suserName'] . "<br>");
        $url = $_SERVER["REQUEST_URI"]; 
        $pos01 = strrpos($url, "userAccount.php");
        $pos02 = strrpos($url, "analyses.php");
        $pos03 = strrpos($url, "calendar.php");
        $pos04 = strrpos($url, "notifications.php");
        $pos05 = strrpos($url, "userSettings.php");
        $pos06 = strrpos($url, "instructions.php");

        if ($pos01 != false) {
            echo("<li class=\"pro-nav__item active\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos02 != false) {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos03 != false) {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos04 != false) {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos05 != false) {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else if ($pos06 != false) {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item active\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
        else {
            echo("<li class=\"pro-nav__item\"><a href=\"userAccount.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_heartbeat_1608928.png\" alt=\"Profile\"><span>Etusivu</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"analyses.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_barChart_292488.png\" alt=\"Profile\"><span>Analyysit</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"calendar.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_calendar-3_322414.png\" alt=\"Profile\"><span>Kalenteri</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"notifications.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_icons_email_1564504.png\" alt=\"Profile\"><span class=\"inbox\">Viestit : <span class=\"counter\">" . $_SESSION['unread'] . "</span></span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"userSettings.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_settings_326699.png\" alt=\"Profile\"><span>Asetukset</span></a></li>");
            echo("<li class=\"pro-nav__item\"><a href=\"instructions.php\"><img class=\"pro-nav-icon\" src=\"images/iconfinder_ic_live_help_48px_352491.png\" alt=\"Profile\"><span>Ohjeita</span></a></li>");
        }
    }
?>