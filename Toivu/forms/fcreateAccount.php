<fieldset><legend>Käyttäjätiedot</legend>
    <form method="post">
        <p>
            Käyttäjänimi *
            <br />
            <input type="text" name="givenUsername" placeholder="käyttäjänimi, vähintään 4 merkkiä" maxlength="15"/>
        </p>
        <p>
            Sähköposti *
            <br />
            <input type="text" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40"/>
        </p>
        <p>
            Salasana *
            <br><span class="desc">Väh. 8 merkkiä sekä väh. yksi numero, iso kirjain ja pieni kirjain</span>
            <br />
            <input type="password" name="givenPassword" placeholder="salasana, vähintään 8 merkkiä" maxlength="20"/>
        </p>
        <p>
            Salasanan vahvistus *
            <br />
            <input type="password" name="givenPasswordVerify" placeholder="salasana uudestaan" maxlength="20"/>
        </p>
        <p>
            Pituus
            <br />
            <input type="text" name="givenHeight" placeholder="pituus senttimetreinä" maxlength="4"/>
        </p>
        <p>
            Paino
            <br />
            <input type="text" name="givenWeight" placeholder="paino kilogrammoina" maxlength="5"/>
        </p>
        <p>
            Syntymäpäivä
            <br />
            <input type="text" name="givenBday" id="datepicker" placeholder="valitse päivämäärä avautuvasta kalenterista" maxlength="10"/>
        </p>
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
        <br />
        <p class="desc">
            * tarkoittaa pakollista tietoa
        </p>
        <p>
            <br />
            <input type="submit" name="submitUser" value="Lähetä"/>
            <input type="reset"  value="Tyhjennä"/>
            <input type="submit" name="submitBack" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>