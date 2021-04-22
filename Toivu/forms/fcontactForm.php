<fieldset><legend>Yhteyslomake</legend>
    <form name="contactForm" onsubmit="return validateForm()" method="post">
        <p>
            Nimi <span class="big_font">*</span>
            <br />
            <input type="text" name="givenName" placeholder="etu- ja sukunimi" maxlength="30" required/>
        </p>
        <p>
            Sähköposti <span class="big_font">*</span>
            <br />
            <input type="email" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40" required/>
        </p>
        <p>
            Viesti <span class="big_font">*</span>
            <br />
            <span class="desc">Max. 1000 merkkiä</span>
            <br />
            <textarea rows="5" cols="40" type="text" name="givenMessage" placeholder="kirjoita tähän viestisi" maxlength="1000" required></textarea>
        </p>
    </form>
</fieldset>