<?php
    session_start();
    include_once("../config/cconfig.php");

    //Muutetaan kalenterilta tullut päiväys sellaiseen, jota voidaan formatoida PHP:lla tietokantaa varten. Jostain syystä päiväykset päivän edellä.
    $startDate = strtotime('-1 day', strtotime($_POST['start'])); //Muutetaan formatoitavaksi tietotyypiksi
    $startDate = date('Y-m-d H:i:s', $startDate); //Formatoidaan datetime-tyypin mukaiseksi

    $endDate = strtotime('-1 day', strtotime($_POST['end'])); //Muutetaan formatoitavaksi tietotyypiksi
    $endDate = date('Y-m-d H:i:s', $endDate); //Formatoidaan datetime-tyypin mukaiseksi

    //Viedään tiedot tietokantaan ja liitetään käyttäjään sen ID:llä.
    if (isset($_POST["title"])) {
        $query = "INSERT INTO wsk21_toivu_calendar (userID, calEvent, calMood, calStart, calEnd, calAllDay) VALUES (:user, :title, :mood, :start_event, :end_event, :allday)";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':user' => $_SESSION['toivu_userID'], //Tapahtuma liitetään nimenomaan sisään kirjautuneeseen käyttäjään
                ':title' => $_POST['title'],
                ':mood' => $_POST['mood'],
                ':start_event' => $startDate,
                ':end_event' => $endDate,
                ':allday' => $_POST['allday']
            )
        );
    }
?>