<?php
    session_start();
    include_once("../config/cconfig.php");

    //Viesti poistetaan tietokannasta
    $session_user = $_SESSION['suserID'];
    $query = "DELETE * FROM wsk21_toivu_notifications WHERE userID = :suser AND notID = :ID";
    $stmt = $DBH -> prepare($query);
    $stmt -> execute(
        array(
            ':user' => $session_user,
            'ID' => $_COOKIE['removeID']
        )
    );
?>