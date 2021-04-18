<?php
    unset($_SESSION['swarningInput']);

    //Päivitetään tiedot, jotka on täytetty lomakkeeseen
    if (isset($_POST['givenUsername'])) {
        try {
            $uname = $_POST['givenUsername'];
            $sql = "UPDATE wsk21_toivu_user SET userName = :uname"
            $stmt = $DBH -> prepare($sql);
            $stmt = bindParam(':uname', $uname);
            $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenEmail'])) {
        //***Email ei saa olla käytetty aiemmin
        $sql = "SELECT COUNT(*) FROM wsk21_toivu_user where userEmail =  " . "'".$_POST['givenEmail']."'"  ;
        
        $kysely = $DBH->prepare($sql);
        $kysely -> execute();				
        $tulos = $kysely -> fetch();

        if ($tulos[0] == 0) { //email ei ole käytössä
            try {
                $email = $_POST['givenEmail'];
                $sql = "UPDATE wsk21_toivu_user SET userEmail = :email"
                $stmt = $DBH -> prepare($sql);
                $stmt = bindParam(':email', $email);
                $stmt -> execute();
            }
            catch (PDOException $e) {
                file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
                $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
            }
        }
        else {
            $_SESSION['swarningInput'] = "Sähköposti on varattu";
        }
    }
    else if (isset($_POST['givenHeight'])) {
        try {
            $height = $_POST['givenHeight'];
        $sql = "UPDATE wsk21_toivu_user SET userHeight = :height"
        $stmt = $DBH -> prepare($sql);
        $stmt = bindParam(':height', $height);
        $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenWeight'])) {
        try {
            $uweight = $_POST['givenWeight'];
            $sql = "UPDATE wsk21_toivu_user SET userWeight = :uweight"
            $stmt = $DBH -> prepare($sql);
            $stmt = bindParam(':uweight', $uweight);
            $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenBday'])) {
        try {
            $bday = $_POST['givenBday'];
            $sql = "UPDATE wsk21_toivu_user SET userWeight = :bday"
            $stmt = $DBH -> prepare($sql);
            $stmt = bindParam(':bday', $bday);
            $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenSex'])) {
        try {
            $sex = $_POST['givenSex'];
            $sql = "UPDATE wsk21_toivu_user SET userSex = :sex"
            $stmt = $DBH -> prepare($sql);
            $stmt = bindParam(':sex', $sex);
            $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    if (isset($_POST['givenPassword'])) {
        try {
            //suolataan annettua salasanaa
            $pwd = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
            $sql = "UPDATE wsk21_toivu_user SET userPwd = :pwd"
            $stmt = $DBH -> prepare($sql);
            $stmt = bindParam(':pwd', $pwd);
            $stmt -> execute();
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
?>