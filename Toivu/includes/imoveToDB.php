<?php
    //Jos näitä tietoja ei ole syötetty, laitetaan tietokantaan nollaa tai tyhjää
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

    //Syntymäpäivän formatointi tietokantaan
    $bday = str_replace('/', '-', $_POST['givenBday']);
    $bday = date("Y-m-d", strtotime($bday));
      
    //***Tiedot sessioon - annettu oikeanlaisena
    $_SESSION['toivu_loggedIn'] = "yes";
    $_SESSION['toivu_userName'] = $_POST['givenUsername'];
    $_SESSION['toivu_userEmail'] = $_POST['givenEmail'];
          
    //Tiedot kantaan
    $data['uname'] = $_POST['givenUsername'];
    $data['email'] = $_POST['givenEmail'];
    $data['height'] = $_POST['givenHeight'];
    $data['uweight'] = $_POST['givenWeight'];
    $data['bday'] = $bday;
    $data['sex'] = $_POST['givenSex'];
    $data['perm'] = $_POST['givenPerm'];
    $data['terms'] = $_POST['givenTerms'];
    //suolataan annettua salasanaa
    $data['pwd'] = password_hash($_POST['givenPassword'].$added, PASSWORD_BCRYPT);
    try {
        $STH = $DBH->prepare("INSERT INTO wsk21_toivu_user (userID, userName, userPwd, userEmail, userHeight, userWeight, userBday, userSex, userPrivacy, userTerms) VALUES (default, :uname, :pwd, :email, :height, :uweight, :bday, :sex, :perm, :terms);");
        $STH -> execute($data);
            
        //Haetaan userID sessioon
        $query = "SELECT userID FROM wsk21_toivu_user WHERE userEmail = :email";
        $stmt = $DBH->prepare($query);
        $stmt -> bindParam(':email', $_SESSION['toivu_userEmail']);
        $stmt -> execute();
        $result = $stmt -> fetch();
        $_SESSION['toivu_userID'] = $result[0];
        echo("<script>location.href = 'userAccount.php';</script>");
    } 
    catch (PDOException $e) {
        file_put_contents('log/DBErrors.txt', 'createAccount.php: '.$e -> getMessage()."\n", FILE_APPEND);
        $_SESSION['swarningInputCreate'] = 'Ongelma tietokannassa';
    }
?>