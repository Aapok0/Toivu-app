<?php
    //Readiness-analyysi
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

    //pNN50-analyysi
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
        $data_array[$i] = array($hrv_arr["name"], $hrv_arr["timeStart"], $hrv_arr["timeEnd"], $hrv_arr["aveHR"], readiness($hrv_arr["R-R"]), pNN50($hrv_arr["R-R"]));
    }

    //HRV-datat taulukossa
    echo "<table id=\"analysis\">";
        echo "<tr>";
            echo "<th>Start time</th>";
            echo "<th>End time</th>";
            echo "<th>Average HR</th>";
            echo "<th>Readiness (0-100)</th>";
            echo "<th>pNN50 (%)</th>";
        echo "</tr>";

        for ($i=0; $i <= $N-1; $i++) {
            echo "<tr>";
                echo "<th>" . $data_array[$i][1] . "</th>";
                echo "<th>" . $data_array[$i][2] . "</th>";
                echo "<th>" . $data_array[$i][3] . "</th>";
                echo "<th>" . $data_array[$i][4] . "</th>";
                echo "<th>" . $data_array[$i][5] . "</th>";
            echo "<tr>";
        }
    echo "</table>";
?>