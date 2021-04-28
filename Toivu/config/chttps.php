<?php
    //Jos HTTPS ei ole käytössä
    if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
    {
        //Käsketään selainta ohjaamaan urliin, jossa käytetään HTTPS:ää
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
        //Estä loppua skriptiä ajamasta loppuun
        exit;
    }
?>