<?php
    session_start();
    include_once("config/cconfig.php");

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
        if ($result[$i][3] == false) {
            $isread = "X";
        }
        else {
            $isread = "✓";
        }

        $data[$i] = array(
            $result[$i]["notID"],
            $result[$i]["notTitle"],
            $result[$i]["notMessage"],
            $result[$i]["notTime"],
            $isread
        );
    }

    //Viestit taulukkoon
    echo "<table id=\"inbox\">";
        echo "<tr class=\"bolder\">";
            echo "<th class=\"bolder\">Otsikko</th>";
            echo "<th class=\"text-center bolder\">Saapunut</th>";
            echo "<th class=\"text-center bolder\">Luettu</th>";
            echo "<th class=\"bolder\">Poista viesti</th>";
        echo "<tr>";

        for ($i=0; $i <= $N-1; $i++) {
            $id = $data[$i][0];
            $title = $data[$i][1];
            $message = $data[$i][2];
            $event = "openMessage('$id','$title','$message')";
            $event2 = "removeMessage('$id')";
            echo "<tr>";
                echo "<th class=\"message_title\">" . $data[$i][1] . "<button class=\"openMessage\" onmousedown=\"$event\">Avaa</button></th>";
                echo "<th class=\"text-center\">" . $data[$i][3] . "</th>";
                echo "<th class=\"text-center\">" . $data[$i][4] . "</th>";
                echo "<th class=\"remove_message\"><button onclick=\"$event2\">Poista</button></th>";
            echo "<tr>";
        }
    echo "</table>";
?>