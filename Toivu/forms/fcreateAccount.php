<fieldset><legend>Käyttäjätiedot</legend>
    <form name="reg_form" onsubmit="return validateForm()" method="post">
        <p>
            Käyttäjänimi <span class="big_font">*</span>
            <br />
            <span class="desc">4-15 merkkiä</span>
            <br />
            <input type="text" name="givenUsername" placeholder="käyttäjänimi" minlength="4" maxlength="15" required/>
        </p>
        <p>
            Sähköposti <span class="big_font">*</span>
            <br />
            <input type="email" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40" required/>
        </p>
        <p>
            Salasana <span class="big_font">*</span>
            <br />
            <span class="desc">Vähintään 8 merkkiä, käytä isoja ja pieniä kirjaimia sekä numeroita.</span>
            <br />
            <input type="password" name="givenPassword" placeholder="salasana" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        </p>
        <p>
            Salasanan vahvistus <span class="big_font">*</span>
            <br />
            <span class="desc">Sama salasana uudelleen</span>
            <br />
            <input type="password" name="givenPasswordVerify" placeholder="salasana uudestaan" maxlength="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
        </p>
        <p>
            Pituus
            <br />
            <span class="desc">Pituus senttimetreinä</span>
            <br />
            <input type="number" name="givenHeight" min="50" max="300"/>
        </p>
        <p>
            Paino
            <br />
            <span class="desc">Paino kilogrammoina</span>
            <br />
            <input type="number" name="givenWeight" min="30" max="500"/>
        </p>
        <p>
            Syntymäpäivä
            <br />
            <span class="desc">Valitse päivämäärä avautuvasta kalenterista.</span>
            <br />
            <input type="text" name="givenBday" id="datepicker" placeholder="päivämäärä" maxlength="10"/>
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
            <input type="button" onclick="location.href='index.php'" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>