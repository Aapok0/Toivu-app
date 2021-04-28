<?php
    session_start();
    include_once("config/cconfig.php");

    unset($_SESSION['swarningInput']);

    //Tiedot kantaan
    $data['userID'] = $_SESSION['toivu_userID']; //varmistetaan käyttäjä
    $data['email'] = $_POST['givenEmail']; //sähköposti, jolla ollaan yhteydessä käyttäjään
    $data['title'] = $_POST['givenTitle'];
    $data['smessage'] = $_POST['givenMessage'];
        
    try {
        $STH = $DBH -> prepare("INSERT INTO wsk21_toivu_support (userID, suppEmail, suppTitle, suppMessage) VALUES (:userID, :email, :title, :smessage);");
        $STH -> execute($data);
        echo("<script>location.href = 'userSettings.php';</script>"); //Vie takaisin asetussivulle
    } 
    catch (PDOException $e) {
        file_put_contents('log/DBErrors.txt', 'userSettings.php: '.$e -> getMessage()."\n", FILE_APPEND);
        $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
    }
?>