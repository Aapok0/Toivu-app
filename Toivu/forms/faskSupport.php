<fieldset><legend class="setting_par">Hae apua Toivun tuelta</legend>
    <form class="setting_par" name="suppForm" method="post">
        <p>
            Sähköposti <span class="big_font">*</span>
            <br />
            <input type="email" name="givenSuppEmail" placeholder="voimassa oleva sähköposti" maxlength="40" required/>
        </p>
        <p>
            Otsikko <span class="big_font">*</span>
            <br />
            <span class="desc">Max. 30 merkkiä</span>
            <br />
            <input type="text" name="givenSuppTitle" placeholder="otsikko" maxlength="30" required/>
        </p>
        <p>
            Viesti tuelle <span class="big_font">*</span>
            <br />
            <span class="desc">Max. 1000 merkkiä</span>
            <br />
            <textarea rows="5" cols="40" type="text" name="givenSuppMessage" placeholder="kirjoita tähän viestisi" maxlength="1000" required></textarea>
        </p>
        <p class="desc">
            <span class="big_font">*</span> tarkoittaa pakollista tietoa
        </p>
        <p>
            <input type="submit" name="submitSupport" value="Lähetä"/>
            <input type="reset"  value="Tyhjennä"/> 
        </p>
    </form>
</fieldset>