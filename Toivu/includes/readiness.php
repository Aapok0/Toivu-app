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
        for ($n=0; $n <= $N-1; $n++) {
            if (sqrt(pow(($RR[$n+1] - $RR[$n]), 2)) > 50) {
                $NN50++;
            }
        }

        //Lasketaan prosenttimäärä sykevälien kokonaismäärästä
        $pNN50 = 1/($N-1) * $NN50 * 100;

        return $pNN50;
    }

    //Alustetaan taulukko johon tallennetaan kaikki graafeihin tarvittavat tiedot JSON-tiedostoista.
    $data_array = array();

    //Huonon viikon data
    //Tarkastetaan kuinka monta tiedostoa kansiossa on
    //$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
    //$N = iterator_count($fi));
    $N = 5;
    
    //Käydään läpi kaikki tiedostot päivä kerrallaan
    for ($i=1; $i <= $N; $i++) {
        $hrv_string = file_get_contents("HRV-demodata/bad/bad" . $i . ".json");
        $hrv_arr = json_decode($hrv_string, true);


        $data_array[$i-1] = array($hrv_arr["name"], $hrv_arr["timeStart"], $hrv_arr["timeEnd"], $hrv_arr["aveHR"], readiness($hrv_arr["R-R"]), pNN50($hrv_arr["R-R"]));
    }
    
    //OK:n viikon data
    //Tarkastetaan kuinka monta tiedostoa kansiossa on
    //$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
    //$N = iterator_count($fi));
    $N = 5;
    
    //Käydään läpi kaikki tiedostot päivä kerrallaan
    for ($i=1; $i <= $N; $i++) {
        $hrv_string = file_get_contents("HRV-demodata/ok/ok" . $i . ".json");
        $hrv_arr = json_decode($hrv_string, true);

        $data_array[$i-1 + $N] = array($hrv_arr["name"], $hrv_arr["timeStart"], $hrv_arr["timeEnd"], $hrv_arr["aveHR"], readiness($hrv_arr["R-R"]), pNN50($hrv_arr["R-R"]));
    }            

    //Hyvän viikon data
    //Tarkastetaan kuinka monta tiedostoa kansiossa on
    //$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
    //$N = iterator_count($fi));
    $N = 5;
    
    //Käydään läpi kaikki tiedostot päivä kerrallaan
    for ($i=1; $i <= $N; $i++) {
        $hrv_string = file_get_contents("HRV-demodata/good/good" . $i . ".json");
        $hrv_arr = json_decode($hrv_string, true);

        $data_array[$i-1 + ($N*2)] = array($hrv_arr["name"], $hrv_arr["timeStart"], $hrv_arr["timeEnd"], $hrv_arr["aveHR"], readiness($hrv_arr["R-R"]), pNN50($hrv_arr["R-R"]));
    }

    //var_dump($data_array);

    $M = 15;
    echo "<table id=\"analysis\">";
        echo "<tr>";
            echo "<th>Start time</th>";
            echo "<th>End time</th>";
            echo "<th>Average HR</th>";
            echo "<th>Readiness (0-100)</th>";
            echo "<th>pNN50 (%)</th>";
        echo "</tr>";

        for ($i=0; $i <= $M-1; $i++) {
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