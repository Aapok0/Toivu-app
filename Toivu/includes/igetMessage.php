<?php
    //Viestien hakeminen tietokannasta
    $data = array();
    $session_user = $_SESSION['suserID'];
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

    for ($i=0; $i <= $N-1; $i++) {
        $isread = "";
        if ($result[$i][3] == "0") {
            $isread = "✓";
        }
        else {
            $isread = "X";
        }

        $data[$i] = array(
            $result[$i]["notID"],
            $result[$i]["notTitle"],
            $result[$i]["notMessage"],
            $result[$i]["notTime"],
            $isread
        );
    }
    
    //Tarkastetaan kuinka monta lukematonta viestiä on
    $unread = 0;
    for ($i=0; $i <= $N-1; $i++) {
        if ($data[$i][4] == "X") {
            $unread++;
        }
    }
    $_SESSION['unread'] = $unread;

    //Viestit taulukkoon
    echo "<table id=\"inbox\">";
        echo "<tr class=\"bolder\">";
            echo "<th>Otsikko</th>";
            echo "<th class=\"text-center bolder\">Saapunut</th>";
            echo "<th class=\"text-center bolder\">Luettu</th>";
        echo "<tr>";

        for ($i=0; $i <= $N-1; $i++) {
            echo "<tr>";
                echo "<th class=\"message_title\">" . $data[$i][1] . "<button id=\"openMessage\" onclick=\"openMessage(". $data[$i][1] ."". $data[$i][2] .")\">Avaa</button></th>";
                echo "<th class=\"text-center\">" . $data[$i][3] . "</th>";
                echo "<th class=\"text-center\">" . $data[$i][4] . "</th>";
            echo "<tr>";
        }
    echo "</table>";
?>