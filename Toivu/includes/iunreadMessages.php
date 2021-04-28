<?php
    session_start();
    include_once("config/cconfig.php");

    //Viestien hakeminen tietokannasta
    $data = array();
    $session_user = $_SESSION['toivu_userID'];
    $query = "SELECT * FROM wsk21_toivu_notifications WHERE userID = :suser ORDER BY notTime DESC";
    $stmt = $DBH -> prepare($query);
    $stmt -> bindParam(':suser', $session_user);
    $stmt -> execute();
    $result = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    //Kuinka monta viestiä käyttäjällä on?
    $query2 = $DBH -> prepare("SELECT COUNT(*) FROM wsk21_toivu_notifications");
    $query2 -> execute();
    $rows = $query2 -> fetch();
    $N = $rows[0];

    //Tarkastetaan kuinka monta lukematonta viestiä on
    $unread = 0;
    for ($i=0; $i <= $N-1; $i++) {
        if ($result[$i]['notRead'] == false) {
            $unread++;
        }
    }
    $_SESSION['toivu_unread'] = $unread;
?>