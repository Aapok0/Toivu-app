<?php
    include("includes/iheader.php");
?>

    <div id="page-container">

        <!-- Päänavigaatio -->
        <nav>
            <div id="nav-bar" class="container">

                <!-- Logo vasempaan ylälaitaan -->
                <div id="logo" class="six columns">
                    <a href="index.php">
                    <img src="images/Toivu-logo_white-regular.png" alt="Toivu-logo">
                    </a>
                </div>

                <div id="nav" class="three columns">
                    <ul>
                        <li><a href="index.php">Koti</a></li>
                        <li><a href="infoPage.php">Tietoa</a></li>
                    </ul>
                </div>

                <!-- Käyttäjätunnistus -->
                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki -->
                <div id="nav" class="three columns">
                    <?php
                        include("includes/inavIndex.php");
                    ?>
                </div>

            </div>
        </nav>

        <!-- Infoteksti -->
        <div class="container">
            <div class="row">
                <div class="twelve columns" style="margin-top: 25%">
                    <h4>Tietoa Toivu-sovelluksesta</h4>
                    <p>Kyky saada tarkkaa tietoa stressistä ja palautumisesta on arvokas työkalu sekä työnantajalle että yksittäiselle työntekijälle. Sekä stressiä, että palautumista on mahdollista mitata sykevälivaihtelulla, jonka mittaamiseen on tarjolla monia hyvinvointilaitteita. Tämä mittaus tapahtuu siten, että sensorit mittaavat sykkeiden välistä aikaa ja tämä data tuodaan sovellukseen käsiteltäväksi. Sovelluksen ideana on kehittää työterveyttä ja ehkäistä ongelmia hyödyntämällä tätä mittausta.</p>
                    <p>Sovelluksen tarkoitus on antaa käyttäjälle tietoa hänen stressistään työpäivän aikana ja antaa heille työkaluja stressistä selviämiseen ja sen vähentämiseen. Sovelluksen toimintaperiaate on kerätä kannettavalla Bluetooth-laitteella sykevälivaihteludataa ja tallentaa se sovelluksen tietokantaan Kubios-sovelluksen kautta. Sovellus laskee mitatusta sykevälivaihteludatasta käyttäjän stressin määrän, jonka jälkeen tarjotaan keinoja sen ehkäisyyn ja vähentämiseen. Käyttäjä voi myös nähdä sekä sykevälivaihteludatan, että stressiarvot graafien avulla.</p>
                    <p>Sovelluksen keskeisiä ominaisuuksia ovat stressiarvojen mittaus, tauottamisen suunnittelu, ohjeet stressistä toipumiseen ja stressin vähentämiseen sekä työterveyteen ohjaus, mikäli arvot eivät parane. Sovelluksen käyttö tapahtuu verkkoselaimessa älypuhelimella tai tietokoneella.</p>
                </div>
            </div>
        </div>

        <?php
            include("includes/ifooter.php");
        ?>

    </div>
</html>