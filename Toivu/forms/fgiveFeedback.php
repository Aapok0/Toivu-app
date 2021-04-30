<fieldset><legend class="setting_par">Anna palautetta Toivun kehittäjille</legend>
    <form class="setting_par" name="feedForm" method="post">
        <p>
            Otsikko <span class="big_font">*</span>
            <br />
            <span class="desc">Max. 30 merkkiä</span>
            <br />
            <input type="text" name="givenTitle" placeholder="otsikko" maxlength="30" required/>
        </p>
        <p>
            Palaute <span class="big_font">*</span>
            <br />
            <span class="desc">Max. 1000 merkkiä</span>
            <br />
            <textarea rows="5" cols="40" name="givenMessage" placeholder="kirjoita tähän palautteesi" maxlength="1000" required></textarea>
        </p>
        <p>
            Arvio sovelluksesta 1-5:
            <div class="rating">
                <span><input type="radio" name="givenRating" id="str5" value="5"><label for="str5"></label></span>
                <span><input type="radio" name="givenRating" id="str4" value="4"><label for="str4"></label></span>
                <span><input type="radio" name="givenRating" id="str3" value="3"><label for="str3"></label></span>
                <span><input type="radio" name="givenRating" id="str2" value="2"><label for="str2"></label></span>
                <span><input type="radio" name="givenRating" id="str1" value="1"><label for="str1"></label></span>
            </div>
            <br />
        </p>
        <p class="desc">
            <span class="big_font">*</span> tarkoittaa pakollista tietoa
        </p>
        <p>
            <input type="submit" name="submitFeedback" value="Lähetä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
        </p>
    </form>
</fieldset>