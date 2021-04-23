<?php
    session_start();
    include_once("../config/cconfig.php");

    //Luettu-statuksen päivittäminen tietokantaan
    $session_user = $_SESSION['suserID'];
    $read = true;
    $query = "UPDATE wsk21_toivu_notifications SET notRead = :nread WHERE userID = :suser AND notID = :ID";
    $stmt = $DBH -> prepare($query);
    $stmt -> execute(
        array(
            ':nread' => $read,
            ':user' => $session_user,
            'ID' => $_COOKIE['readID']
        )
    );
?>