<?php
    session_start();
    include_once("config/cconfig.php");

    unset($_SESSION['swarningInput']);

    //Päivitetään tiedot, jotka on täytetty lomakkeeseen
    //Käyttäjänimen muuttaminen
    if (isset($_POST['givenUsername'])) {
        try {
            $uname = $_POST['givenUsername'];
            $suser = $_SESSION['toivu_userID'];
            $sql = "UPDATE wsk21_toivu_user SET userName = :uname WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':uname' => $uname,
                ':suser' => $suser
            ));
            $_SESSION['toivu_userName'] = $_POST['givenUsername'];
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }

    //Sähköpostin muuttaminen
    else if (isset($_POST['givenEmail'])) {
        try {
            $email = $_POST['givenEmail'];
            $suser = $_SESSION['toivu_userID'];
            $sql = "UPDATE wsk21_toivu_user SET userEmail = :email WHERE userID = :suser";
            $stmt = $DBH -> prepare($sql);
            $stmt -> execute(array(
                ':email' => $email,
                ':suser' => $suser
            ));
            $_SESSION['toivu_userEmail'] = $_POST['givenEmail'];
            echo("<script>location.href = 'userSettings.php';</script>");
        }
        catch (PDOException $e) {
            file_put_contents('log/DBErrors.txt', 'updateAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
            $_SESSION['swarningInput'] = 'Ongelma tietokannassa';
        }
    }

    //Pituuden muuttaminen
    else if (isset($_POST['givenHeight'])) {
        try {
            $height = $_POST['givenHeight'];
            $suser = $_SESSION['toivu_userID'];
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

    //Painon muuttaminen
    else if (isset($_POST['givenWeight'])) {
        try {
            $uweight = $_POST['givenWeight'];
            $suser = $_SESSION['toivu_userID'];
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

    //Syntymäpäivän muuttaminen
    else if (isset($_POST['givenBday'])) {

        //Syntymäpäivän formatointi tietokantaan
        $bday = str_replace('/', '-', $_POST['givenBday']);
        $bday = date("Y-m-d", strtotime($bday));

        try {
            $suser = $_SESSION['toivu_userID'];
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

    //Sukupuolen muuttaminen
    else if (isset($_POST['givenSex'])) {
        try {
            $sex = $_POST['givenSex'];
            $suser = $_SESSION['toivu_userID'];
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

    //Salasanan muuttaminen
    else if (isset($_POST['givenPassword'])) {
        try {
            //suolataan annettua salasanaa
            $pwd = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
            $suser = $_SESSION['toivu_userID'];
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