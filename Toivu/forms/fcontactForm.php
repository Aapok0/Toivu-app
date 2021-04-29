<fieldset><legend>Yhteyslomake</legend>
    <form name="contactForm" action="includes/icontactUs.php" method="post">
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
            <textarea rows="5" cols="40" name="givenMessage" placeholder="kirjoita tähän viestisi" maxlength="1000" required></textarea>
        </p>
        <p class="desc">
            <span class="big_font">*</span> tarkoittaa pakollista tietoa
        </p>
        <p>
            <input type="submit" name="submitContact" value="Lähetä"/>
            <input type="reset"  value="Tyhjennä"/>
        </p>
    </form>
</fieldset>