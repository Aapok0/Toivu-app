<?php
    function readiness($RR) {
        //Alustetaan ensin muuttuja
        $rmssd = 0;
        
        //Sykevälien kokonaismäärä
        $N = count($RR);

        //Summataan kaikki sykevälivaihtelut (ero R-R-intervallien välillä)
        for ($n=1; $n <= $N-1; $n++) {
            $rmssd += pow(($RR[$n+1] - $RR[$n]), 2);
        }

        //Lasketaan keskimääräinen sykevälivaihtelu
        $rmssd = sqrt(1/($N-1) * $rmssd);

        //Lasketaan readiness-analyysin tulos -> 0 - 6.5
        $lnrmssd = log($rmssd);

        //Prosenttimäärä maksimiarvosta 6.5
        $readiness = $lnrmssd/6.5 * 100;

        return $readiness;
    }
?>