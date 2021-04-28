<?php
    //Viesti, joka lähetetään käyttäjälle rekisteröitymisen ohella
    $welTitle = "Tervetuloa Toivu-hyvinvointisovelluksen käyttäjäksi!";
    $welMessage = "Hei ja tervetuloa!  Olemme iloisia, että työnantajasi on valinnut Toivun ja sinä olet päättänyt kokeilla tätä sovellusta. Voit mitata sykevälivaihtelua erillisellä laitteella, jonka yhdistät sovellukseen profiilisivullasi, ja sovellus antaa näistä mittauksista arvion stressistäsi. Voit myös lukea, miten nämä analyysit toimivat niiden sivulta. Lisäksi voit tallentaa kalenteriin vointiisi vaikuttavia päivittäisiä asioita ja arvioida oloasi. On tärkeää yrittää löytää yhdistäviä tekijöitä työpäivistäsi stressiin, jotta voit löytää keinoja stressinhallintaan. Toivottavasti saat kaiken mahdollisen hyödyn irti sovelluksestamme! Ystävällisin terveisin, Toivun kehitystiimi";

    $sql ="INSERT INTO wsk21_toivu_notifications (userID, notTitle, notMessage) VALUES (:user, :wtitle, :wmessage);";
    $stmt = $DBH -> prepare($sql);
    $stmt -> execute(array(
        'user' => $_SESSION['toivu_userID'],
        'wtitle' => $welTitle,
        'wmessage' => $welMessage
    ));
?>