<?php
    session_start();
    include_once("../config/cconfig.php");

    //Viesti poistetaan tietokannasta
    $session_user = $_SESSION['toivu_userID']; //varmistetaan käyttäjä
    var_dump($_POST['id']);
    $array = array(
        'suser' => $session_user,
        'ID' => $_POST['id'] //varmistetaan viesti
    );
    $query = "DELETE FROM wsk21_toivu_notifications WHERE userID = :suser AND notID = :ID";
    $stmt = $DBH -> prepare($query);
    $stmt -> execute($array);
?>