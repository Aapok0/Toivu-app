<?php
    session_start();
    include_once("../config/cconfig.php");

    //Poistetaan käyttäjän (userID) kalenteritieto (calID)
    if(isset($_POST["id"])) {
        $query = "DELETE from wsk21_toivu_calendar WHERE calID = :id AND userID = :suser";
        $stmt = $DBH -> prepare($query);
        $stmt -> execute(
            array(
                ':id' => $_POST['id'], //Poistetaan oikea viesti
                ':suser' => $_SESSION['toivu_userID'] //Varmistetaan käyttäjä
            )
        );
    }
?>