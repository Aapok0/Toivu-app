<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../config/cconfig.php");

    //Readiness-analyysi (Lähteet: doi: 10.3389/fpubh.2017.00258, https://www.kubios.com/hrv-analysis-methods/)
    function readiness($RR) {
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

        //Lasketaan readiness-analyysin tulos -> 0 - 6.5
        $lnrmssd = log($rmssd);

        //Prosenttimäärä maksimiarvosta 6.5
        $readiness = $lnrmssd/6.5 * 100;

        return $readiness;
    }

    //pNN50-analyysi (Lähteet: doi: 10.3389/fpubh.2017.00258, https://www.kubios.com/hrv-analysis-methods/)
    function pNN50($RR) {
        //Alustetaan ensin muuttuja
        $NN50 = 0;
        
        //Sykevälien kokonaismäärä
        $N = count($RR);

        //Etsitään kaikki peräkkäiset sykevälit, jotka ovat yli 50ms
        for ($n=0; $n <= $N-2; $n++) {
            if ((sqrt(pow(($RR[$n+1] - $RR[$n]), 2)) > 50) && (sqrt(pow(($RR[$n+2] - $RR[$n+1]), 2)) > 50)) {
                $NN50++;
            }
        }

        //Lasketaan prosenttimäärä sykevälien kokonaismäärästä
        $pNN50 = 1/($N-1) * $NN50 * 100;

        return $pNN50;
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
        $data[$i] = array("date" => substr($hrv_arr["timeEnd"], 0, -13), "readiness" => readiness($hrv_arr["R-R"]), "pNN50" => pNN50($hrv_arr["R-R"]));
    }

    echo(json_encode($data));
?>