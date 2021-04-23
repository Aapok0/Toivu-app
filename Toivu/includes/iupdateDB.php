<?php
    session_start();
    include_once("config/cconfig.php");

    unset($_SESSION['swarningInput']);

    //Päivitetään tiedot, jotka on täytetty lomakkeeseen
    if (isset($_POST['givenUsername'])) {
        try {
            $uname = $_POST['givenUsername'];
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userName = :uname WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':uname' => $uname,
                ':suser' => $suser
            ));
            $_SESSION['suserName'] = $_POST['givenUsername'];
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenEmail'])) {
        //***Email ei saa olla käytetty aiemmin
        $sql = "SELECT COUNT(*) FROM wsk21_toivu_user where userEmail =  " . "'".$_POST['givenEmail']."'"  ;
        
        $kysely = $DBH -> prepare($sql);
        $kysely -> execute();				
        $tulos = $kysely -> fetch();

        if ($tulos[0] == 0) { //email ei ole käytössä
            try {
                $email = $_POST['givenEmail'];
                $suser = $_SESSION['suserID'];
                $sql = "UPDATE wsk21_toivu_user SET userEmail = :email WHERE userID = :suser";
                $stmt = $DBH -> prepare($sql);
                $stmt -> execute(array(
                    ':email' => $email,
                    ':suser' => $suser
                ));
                $_SESSION['suserEmail'] = $_POST['givenEmail'];
                echo("<script>location.href = 'userSettings.php';</script>");
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
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userHeight = :height WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':height' => $height,
                ':suser' => $suser
            ));
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenWeight'])) {
        try {
            $uweight = $_POST['givenWeight'];
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userWeight = :uweight WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':uweight' => $uweight,
                ':suser' => $suser
            ));
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenBday'])) {
        try {
            $bday = $_POST['givenBday'];
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userBday = :bday WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':bday' => $bday,
                ':suser' => $suser
            ));
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
    else if (isset($_POST['givenSex'])) {
        try {
            $sex = $_POST['givenSex'];
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userSex = :sex WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':sex' => $sex,
                ':suser' => $suser
            ));
            echo("<script>location.href = 'userSettings.php';</script>");
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
            $suser = $_SESSION['suserID'];
            $sql = "UPDATE wsk21_toivu_user SET userPwd = :pwd WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':pwd' => $pwd,
                ':suser' => $suser
            ));
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }
?>