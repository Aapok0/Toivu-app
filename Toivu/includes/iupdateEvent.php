<?php
    session_start();
    include_once("../config/cconfig.php");

    $startDate = strtotime('-1 day', strtotime($_POST['start']));
    $startDate = date('Y-m-d H:i:s', $startDate);

    $endDate = strtotime('-1 day', strtotime($_POST['end']));
    $endDate = date('Y-m-d H:i:s', $endDate);

    if(isset($_POST["id"])) {
        $query = "UPDATE wsk21_toivu_calendar SET calStart = :start_event, calEnd = :end_event WHERE calID = :id AND userID = :suser";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':start_event' => $startDate,
                ':end_event' => $endDate,
                ':id' => $_POST['id'],
                ':suser' => $_SESSION['suserID']
            )
        );
    }
?>