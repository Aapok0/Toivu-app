<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $user = 'aapokok';
    $pass = 'g9AwBec81Uz';
    $host = 'mysql.metropolia.fi';
    $dbname = 'aapokok';
    $added='#â‚¬%&&/'; 

    //Tietokantayhteys sulkeutuu automaattisesti kun </html> eli sivun scripti loppuu
    //Normaali olion elinkaari
    try { //Avataan viittaus tietokantaan
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        // virheenkasittely: virheet aiheuttavat poikkeuksen
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        // merkistö utf8
        $DBH->exec("SET NAMES utf8;");
        //echo "Yhteys OK."; //Kommentoi pois validoitavassa versiossa
    } catch(PDOException $e) {
        echo "Yhteysvirhe: " . $e->getMessage(); 
        file_put_contents('log/DBErrors.txt', 'Connection: '.$e->getMessage()."\n", FILE_APPEND);
    }//HUOM hakemistopolku!

    $data = array();

    $query = $DBH -> prepare("SELECT COUNT(*) FROM wsk21_toivu_hrv");
    $query -> execute();
    $rows = $query -> fetch();
    $N = $rows[0];

    $query = $DBH -> prepare("SELECT hrvData FROM wsk21_toivu_hrv");
    $query -> execute();
    $result = $query -> fetchAll(PDO::FETCH_ASSOC);

    for ($i=0; $i <= $N-1; $i++) {
        $hrv_arr = json_decode($result[$i]["hrvData"], true);
        $data[$i] = array("date" => substr($hrv_arr["timeEnd"], 0, -13), "value" => $hrv_arr["aveHR"]);
    }

    echo(json_encode($data));
?>