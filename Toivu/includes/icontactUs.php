<?php
    if($_POST["submitContact"]) {
        $recipient="aapo.kokko@metropolia.fi";
        $subject="Yhteydenotto Toivu-sovellukseen liittyen";
        $sender = $_POST["givenName"];
        $senderEmail=$_POST["givenEmail"];
        $message=$_POST["givenMessage"];

        $mailBody="Nimi: $sender\nEmail: $senderEmail\n\n$message";

        mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");
        
        echo("<script>location.href = 'index.php';");
    }
?>