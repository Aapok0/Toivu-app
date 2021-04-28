<?php
    //Readiness-analyysi (Lähteet: doi: 10.3389/fpubh.2017.00258, https://www.kubios.com/hrv-analysis-methods/, https://www.duodecimlehti.fi/duo50084)
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

        return round($readiness, 2);
    }

    //pNN50-analyysi (Lähteet: doi: 10.3389/fpubh.2017.00258, https://www.kubios.com/hrv-analysis-methods/, https://www.duodecimlehti.fi/duo50084)
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

        return round($pNN50, 2);
    }

    //Alustetaan taulukko johon tallennetaan kaikki graafeihin tarvittavat tiedot JSON-tiedostoista.
    $data_array = array();

    //Tarkastetaan kuinka monta hrv-dataa on käyttäjällä
    //Lopullisessa versiossa tarkistetaan WHERE ehdolla, että haetaan sisäänkirjautuneen käyttäjän dataa.
    $query = $DBH -> prepare("SELECT COUNT(*) FROM wsk21_toivu_hrv");
    $query -> execute();
    $rows = $query -> fetch();
    $N = $rows[0];

    //Käydään datat läpi, suoritetaan niihin analyysit ja sijoitetaan datat taulukkoon.
    //Lopullisessa versiossa tarkistetaan WHERE ehdolla, että haetaan sisäänkirjautuneen käyttäjän dataa.
    $query = $DBH -> prepare("SELECT hrvData FROM wsk21_toivu_hrv");
    $query -> execute();
    $result = $query -> fetchAll(PDO::FETCH_ASSOC);

    for ($i=0; $i <= $N-1; $i++) {
        $hrv_arr = json_decode($result[$i]["hrvData"], true);
        $start = strtotime($hrv_arr["timeStart"]);
        $start = date('Y-m-d H:i:s', $start);
        $end = strtotime($hrv_arr["timeEnd"]);
        $end = date('Y-m-d H:i:s', $end);
        $data_array[$i] = array($hrv_arr["name"], $start, $end, round($hrv_arr["aveHR"], 1), readiness($hrv_arr["R-R"]), pNN50($hrv_arr["R-R"]));
    }

    //HRV-datat taulukossa
    echo "<h2 class=\"text-center\">Yhteenveto sinun mittauksista ja analyyseista</h2>";
    echo "<h4 class=\"text-center noprint\">Tulosta tuloksesi työterveyttä varten <button onclick=\"window.print();return false;\">Tulosta</button></h4>";
    echo "<table id=\"analysis\">";
        echo "<thead>";
            echo "<tr class=\"bolder\">";
                echo "<th>Aloitus</th>";
                echo "<th>Lopetus</th>";
                echo "<th>Keskisyke</th>";
                echo "<th>Readiness (%)</th>";
                echo "<th>pNN50 (%)</th>";
            echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        for ($i=0; $i <= $N-1; $i++) {
            echo "<tr>";
                echo "<td class=\"analysis_td\">" . $data_array[$i][1] . "</td>";
                echo "<td class=\"analysis_td\">" . $data_array[$i][2] . "</td>";
                echo "<td class=\"analysis_td\">" . $data_array[$i][3] . "</td>";
                echo "<td class=\"analysis_td\">" . $data_array[$i][4] . "</td>";
                echo "<td class=\"analysis_td\">" . $data_array[$i][5] . "</td>";
            echo "<tr>";
        }
        echo "</tbody>";
    echo "</table>";
?>