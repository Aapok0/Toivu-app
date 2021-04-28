<?php
    session_start();
    include_once("../config/cconfig.php");

    //Luettu-statuksen päivittäminen tietokantaan
    $session_user = $_SESSION['toivu_userID'];
    $read = true;
    $array = array(
        'nread' => $read,
        'suser' => $session_user,
        'ID' => $_POST['id']
    );
    
    $query = "UPDATE wsk21_toivu_notifications SET notRead = :nread WHERE userID = :suser AND notID = :ID";
    $stmt = $DBH -> prepare($query);
    $stmt -> execute($array);
?>