<?php
    unset($_SESSION['swarningInput']);

    if (empty($_POST['givenHeight'])) {
        $_POST['givenHeight'] = "0";
    }
    if (empty($_POST['givenWeight'])) {
        $_POST['givenWeight'] = "0";
    }
    if (empty($_POST['givenBday'])) {
        $_POST['givenBday'] = "0000-00-00";
    }
    if (empty($_POST['givenSex'])) {
        $_POST['givenSex'] = "none";
    }
      
    //***Tiedot sessioon - annettu oikeanlaisena
    $_SESSION['sloggedIn'] = "yes";
    $_SESSION['suserName'] = $_POST['givenUsername'];
    $_SESSION['suserEmail'] = $_POST['givenEmail'];
          
    //Tiedot kantaan
    $data['uname'] = $_POST['givenUsername'];
    $data['email'] = $_POST['givenEmail'];
    $data['height'] = $_POST['givenHeight'];
    $data['uweight'] = $_POST['givenWeight'];
    $data['bday'] = $_POST['givenBday'];
    $data['sex'] = $_POST['givenSex'];
    //suolataan annettua salasanaa
    $data['pwd'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
    try {
        //***Email ei saa olla käytetty aiemmin
        $sql = "SELECT COUNT(*) FROM wsk21_toivu_user where userEmail =  " . "'".$_POST['givenEmail']."'"  ;
        $kysely = $DBH->prepare($sql);
        $kysely -> execute();				
        $tulos = $kysely -> fetch();
        if ($tulos[0] == 0) { //email ei ole käytössä
            $STH = $DBH->prepare("INSERT INTO wsk21_toivu_user (userID, userName, userPwd, userEmail, userHeight, userWeight, userBday, userSex) VALUES (default, :uname, :pwd, :email, :height, :uweight, :bday, :sex);");
            $STH -> execute($data);
            header("Location: index.php"); //Palataan pääsivulle kirjautuneena
        }
        else {
            $_SESSION['swarningInput'] = "Sähköposti on varattu";
        }
    } 
    catch (PDOException $e) {
        file_put_contents('log/DBErrors.txt', 'createAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
        $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
    }
?>