<?php
    session_start();
    include_once("../config/cconfig.php");

    if (isset($_POST["title"])) {
        $query = "INSERT INTO wsk21_toivu_calendar (userID, calEvent, calMood calStart, calEnd) VALUES (:user, :title, :mood, :start_event, :end_event)";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':user' => $_SESSION['suserID'],
                ':title' => $_POST['title'],
                ':mood' => $_POST['mood'],
                ':start_event' => $_POST['start'],
                ':end_event' => $_POST['end']
            )
        );
    }
?>