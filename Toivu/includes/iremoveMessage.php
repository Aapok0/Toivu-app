<?php
    session_start();
    include_once("config/cconfig.php");

    //Luettu-statuksen päivittäminen tietokantaan
    $session_user = $_SESSION['suserID'];
    $read = true;
    $query = "DELETE * FROM wsk21_toivu_notifications WHERE userID = :suser, notID = :ID";
    $stmt = $DBH -> prepare($query);
    $stmt -> execute(
        array(
            ':user' => $session_user,
            'ID' => $ID
        )
    );
?>