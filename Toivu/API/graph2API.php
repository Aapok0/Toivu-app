<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../config/cconfig.php");

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