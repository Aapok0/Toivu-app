<?php
    unset($_SESSION['swarningInput']);

    //Tiedot kantaan
    $data['userID'] = $_SESSION['suserID'];
    $data['email'] = $_POST['givenEmail'];
    $data['title'] = $_POST['givenTitle'];
    $data['smessage'] = $_POST['givenMessage'];
        
    try {
        $STH = $DBH->prepare("INSERT INTO wsk21_toivu_feedback (userID, userID, feedTitle, feedMessage, feedRating) VALUES (:userID, :email, :title, :smessage);");
        $STH -> execute($data);
        header("Location: userSettings.php"); //Vie takaisin asetussivulle
    } 
    catch (PDOException $e) {
        file_put_contents('log/DBErrors.txt', 'userSettings.php: '.$e -> getMessage()."\n", FILE_APPEND);
        $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
    }
?>