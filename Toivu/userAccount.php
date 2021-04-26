<?php
    session_start();
    include("includes/iheader.php");
?>

    <div class="page-container">

        <!-- Uusi päänavigaatio -->
        <div class="header-background">
            <div class="container">
                <header class="site-header site-header__wrapper">
                    <div class="site-header__start">
                        <!-- Logo vasempaan ylälaitaan -->
                        <div id="logo">
                            <a href="index.php">
                                <img src="images/Toivu2.png" alt="Toivu-logo">
                            </a>
                        </div>
                    </div>

                    <div class="site-header__end">
                        <nav>
                            <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
                            <button class="nav__toggle button-light" aria-expanded="false" type="button">
                                Päävalikko
                            </button>
                            <ul class="nav__wrapper no-bullets">
                                <li class="nav__item">
                                    <a href="index.php">
                                        <img class="nav-icon" src="images/iconfinder_home_1608930.png" alt="Home">
                                        <span>Koti</span>
                                    </a>
                                </li>
                                <li class="nav__item">
                                    <a href="infoPage.php">
                                        <img class="nav-icon" src="images/iconfinder_ic_info_48px_352431.png" alt="Info">
                                        <span>Tietoa</span>
                                    </a>
                                </li>
                                <!-- Käyttäjätunnistus -->
                                <!-- Kirjautumis- ja rekisteröintilinkki ja kirjautumisen jälkeen uloskirjaus- ja oma sivu -linkki -->
                                <?php
                                    include("includes/inavIndex.php");
                                ?>
                            </ul>
                        </nav>
                    </div>        
                </header>
            </div>
        </div>

        <!-- Profiilinavigaatio, joka näkyy vain kirjautuneille -->
        <div class="container">
            <div class="row">
                <div class="twelve columns profile-header profile-header__wrapper">
                    <nav class="profile-header__end">
                        <!-- Navigaation tilalle tulee hampurilaismenu ruudun pienentyessä -->
                        <button class="pro-nav__toggle button-light" aria-expanded="false" type="button">
                            Profiilivalikko
                        </button>
                        <ul class="pro-nav__wrapper no-bullets">
                            <?php
                                include("includes/inavProfile.php");
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Profiilisivun otsikko ja tervehdys -->
        <div class="container profile-page">
            <div class="row">
                <div class="twelve columns">
                    <h1>
                        <?php
                            echo("<h1 class=\"text-center first-heading\">Tervetuloa takaisin " . $_SESSION['suserName'] . "!</h1>");
                        ?>
                    </h1>
                </div>
            </div>

            <!-- Ehdotuksia ja neuvoja palautumiseen. Optimi tilanteessa reagoisi käyttäjän mittauksiin ja esim. kalenteri-tageihin. -->
            <div class="row">
                <h3 class="text-center">Apua palautumiseen ja stressinhallintaan</h3>
                <div class="one-half column">
                    <div class="advice-column">
                        <h4 class="text-center">Hengitysharjoitukset</h4>
                        <img class="front-img" src="images/nose-breathing2.jpg" alt="Nenähengitys">
                        <p class="advice">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, aperiam! Nisi facilis inventore nulla, obcaecati mollitia optio asperiores, voluptatum quo, distinctio unde eius quaerat deserunt autem corrupti explicabo voluptatibus error.
                        Nobis at repudiandae expedita tempore laborum impedit, eligendi accusantium ut, sit temporibus quibusdam earum dolorum iusto! Optio cupiditate ut neque veniam nam, ipsam aliquid nisi, est ipsum itaque soluta harum.
                        Fugiat incidunt, voluptates sit iste dignissimos quibusdam, dolores molestias deserunt fugit facilis repellat. Accusantium quis, explicabo fuga, reiciendis autem expedita eaque rerum laboriosam architecto animi ad fugiat officia exercitationem repudiandae.</p>
                    </div>
                    <div class="advice-column">
                        <h4 class="text-center">Apua nukahtamiseen</h4>
                        <img class="front-img" src="images/sleep-problems.jpg" alt="Uniongelmat">
                        <p class="advice">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, aperiam! Nisi facilis inventore nulla, obcaecati mollitia optio asperiores, voluptatum quo, distinctio unde eius quaerat deserunt autem corrupti explicabo voluptatibus error.
                        Nobis at repudiandae expedita tempore laborum impedit, eligendi accusantium ut, sit temporibus quibusdam earum dolorum iusto! Optio cupiditate ut neque veniam nam, ipsam aliquid nisi, est ipsum itaque soluta harum.
                        Fugiat incidunt, voluptates sit iste dignissimos quibusdam, dolores molestias deserunt fugit facilis repellat. Accusantium quis, explicabo fuga, reiciendis autem expedita eaque rerum laboriosam architecto animi ad fugiat officia exercitationem repudiandae.</p>
                    </div>
                </div>
                <div class="six columns no-margin">
                    <div class="advice-column">
                        <h4 class="text-center">Lähde liikkeelle!</h4>
                        <img class="front-img" src="images/people-walking-dog-.jpg" alt="Ulkona kävely">
                        <p class="advice">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, aperiam! Nisi facilis inventore nulla, obcaecati mollitia optio asperiores, voluptatum quo, distinctio unde eius quaerat deserunt autem corrupti explicabo voluptatibus error.
                        Nobis at repudiandae expedita tempore laborum impedit, eligendi accusantium ut, sit temporibus quibusdam earum dolorum iusto! Optio cupiditate ut neque veniam nam, ipsam aliquid nisi, est ipsum itaque soluta harum.
                        Fugiat incidunt, voluptates sit iste dignissimos quibusdam, dolores molestias deserunt fugit facilis repellat. Accusantium quis, explicabo fuga, reiciendis autem expedita eaque rerum laboriosam architecto animi ad fugiat officia exercitationem repudiandae.</p>
                    </div>
                    <div class="advice-column">
                        <h4 class="text-center">Miten tauottaa työpäivää?</h4>
                        <img class="front-img" src="images/hammock-break.jpg" alt="Tauko">
                        <p class="advice">Lorem ipsum dolor sit amet consectetur adipisicing elit. A, aperiam! Nisi facilis inventore nulla, obcaecati mollitia optio asperiores, voluptatum quo, distinctio unde eius quaerat deserunt autem corrupti explicabo voluptatibus error.
                        Nobis at repudiandae expedita tempore laborum impedit, eligendi accusantium ut, sit temporibus quibusdam earum dolorum iusto! Optio cupiditate ut neque veniam nam, ipsam aliquid nisi, est ipsum itaque soluta harum.
                        Fugiat incidunt, voluptates sit iste dignissimos quibusdam, dolores molestias deserunt fugit facilis repellat. Accusantium quis, explicabo fuga, reiciendis autem expedita eaque rerum laboriosam architecto animi ad fugiat officia exercitationem repudiandae.</p>
                    </div>
                </div>
            </div>

            <!-- HRV-analyysit ja tiedot taulukkoon -->
            <div class="row">
                <div class="twelve columns">
                    <?php
                        include("includes/ireadiness.php");
                    ?>
                </div>
            </div>
        </div>

        <script src="js/collapse-menu.js"></script>

<?php
    include("includes/ifooter.php");
?>