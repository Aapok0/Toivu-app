<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../config/cconfig.php");

    //HRV-arvot
    function rmssd($RR) {
        //Alustetaan ensin muuttuja
        $rmssd = 0;
            
        //Sykevälien kokonaismäärä
        $N = count($RR);

        //Summataan kaikki sykevälivaihtelut (ero R-R-intervallien välillä)
        for ($n=0; $n <= $N-2; $n++) {
            $rmssd += pow(($RR[$n+1] - $RR[$n]), 2);
        }

        //Lasketaan keskimääräinen RMSSD
        $rmssd = sqrt(1/($N-1) * $rmssd);

        return $rmssd;
    }

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
        $data[$i] = array("date" => substr($hrv_arr["timeEnd"], 0, -13), "value" => rmssd($hrv_arr["R-R"]));
    }

    echo(json_encode($data));
?>