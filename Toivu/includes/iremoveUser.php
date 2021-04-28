<?php
    session_start();
    include_once("../config/cconfig.php");

    //Poistetaan käyttäjän tiedot jokaisesta tietokannan taulusta
    $query1 = "DELETE FROM wsk21_toivu_user WHERE userID = :suser";
    $stmt1 = $DBH -> prepare($query1);
    $stmt1 -> bindParam(':suser', $_SESSION['toivu_userID']);
    $stmt1 -> execute();

    $query2 = "DELETE FROM wsk21_toivu_kubios WHERE userID = :suser";
    $stmt2 = $DBH -> prepare($query2);
    $stmt2 -> bindParam(':suser', $_SESSION['toivu_userID']);
    $stmt2 -> execute();
    
    $query3 = "DELETE FROM wsk21_toivu_hrv WHERE userID = :suser";
    $stmt3 = $DBH -> prepare($query3);
    $stmt3 -> bindParam(':suser', $_SESSION['toivu_userID']);
    $stmt3 -> execute();

    $query4 = "DELETE FROM wsk21_toivu_calendar WHERE userID = :suser";
    $stmt4 = $DBH -> prepare($query4);
    $stmt4 -> bindParam(':suser', $_SESSION['toivu_userID']);
    $stmt4 -> execute();

    $query5 = "DELETE FROM wsk21_toivu_notifications WHERE userID = :suser";
    $stmt5 = $DBH -> prepare($query5);
    $stmt5 -> bindParam(':suser', $_SESSION['toivu_userID']);
    $stmt5 -> execute();

    //Lopetetaan ja tuhotaan sessio ja palataan kotisivulle
    session_unset();
    session_destroy();
    echo("<script>location.href = '../index.php';</script>");
?>