<fieldset><legend>Käyttäjätiedot</legend>
    <form name="reg_form" onsubmit="return validateForm()" method="post">
        <p>
            Käyttäjänimi <span class="big_font">*</span>
            <br />
            <input type="text" name="givenUsername" placeholder="käyttäjänimi, vähintään 4 merkkiä" minlength="4" maxlength="15" required/>
        </p>
        <p>
            Sähköposti <span class="big_font">*</span>
            <br />
            <input type="text" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40" required/>
        </p>
        <p>
            Salasana <span class="big_font">*</span>
            <br><span class="desc">Väh. 8 merkkiä sekä väh. yksi numero, iso kirjain ja pieni kirjain</span>
            <br />
            <input type="password" name="givenPassword" placeholder="salasana, vähintään 8 merkkiä" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        </p>
        <p>
            Salasanan vahvistus <span class="big_font">*</span>
            <br />
            <input type="password" name="givenPasswordVerify" placeholder="salasana uudestaan" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        </p>
        <p>
            Pituus
            <br />
            <input type="number" name="givenHeight" placeholder="pituus senttimetreinä" min="50" max="300"/>
        </p>
        <p>
            Paino
            <br />
            <input type="number" name="givenWeight" placeholder="paino kilogrammoina" min="30" max="500"/>
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
        <span class="big_font">*</span> tarkoittaa pakollista tietoa
        </p>
        <p>
            <br />
            <input type="submit" name="submitUser" value="Lähetä"/>
            <input type="reset"  value="Tyhjennä"/>
            <input type="submit" name="submitBack" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>