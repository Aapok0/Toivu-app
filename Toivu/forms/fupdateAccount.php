<fieldset><legend>Päivitä käyttäjätietoja</legend>
    <form name="update_name_form" method="post">
        <p>
            Käyttäjänimi
            <br />
            <span class="desc">4-15 merkkiä</span>
            <br />
            <input type="text" name="givenUsername" placeholder="käyttäjänimi" minlength="4" maxlength="15"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitName" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_email_form" method="post">
        <p>
            Sähköposti
            <br />
            <input type="email" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitEmail" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_password_form" method="post">
        <p>
            Salasana
            <br />
            <span class="desc">Vähintään 8 merkkiä, käytä isoja ja pieniä kirjaimia sekä numeroita.</span>
            <br />
            <input type="password" name="givenPassword" placeholder="salasana" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        </p>
        <p>
            Salasanan vahvistus
            <br />
            <span class="desc">Sama salasana uudelleen</span>
            <br />
            <input type="password" name="givenPasswordVerify" placeholder="salasana uudestaan" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitPass" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_height_form" method="post">
        <p>
            Pituus
            <br />
            <span class="desc">Pituus senttimetreinä</span>
            <br />
            <input type="number" name="givenHeight" placeholder="pituus senttimetreinä" min="50" max="300"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitHeight" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_weight_form" method="post">
        <p>
            Paino
            <br />
            <span class="desc">Paino kilogrammoina</span>
            <br />
            <input type="number" name="givenWeight" placeholder="paino kilogrammoina" min="30" max="500"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitWeight" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_bday_form" method="post">
        <p>
            Syntymäpäivä
            <br />
            <span class="desc">Valitse päivämäärä avautuvasta kalenterista.</span>
            <br />
            <input type="text" name="givenBday" id="datepicker" placeholder="päivämäärä" maxlength="10"/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitBday" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>

    <form name="update_sex_form" method="post">
        <p>
            Sukupuoli
            <br />
            <input type="radio" id="male" name="givenSex" value="male">
            <label for="male">Mies</label><br>
            <input type="radio" id="female" name="givenSex" value="female">
            <label for="female">Nainen</label><br>
            <input type="radio" id="other" name="givenSex" value="other">
            <label for="other">Muu</label>
        </p>
        <p>
            <br />
            <input type="submit" name="submitSex" value="Päivitä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='userSettings.php'" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>