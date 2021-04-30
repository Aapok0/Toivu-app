<fieldset><legend>Salasanan palautus</legend>
    <form name="passform" method="post">
        <p>
            Kirjoita tähän sovelluksessa käyttämäsi sähköposti ja lähetämme sinulle uuden salasanan.
            <br />
            <input type="email" name="givenEmail" placeholder="käyttämäsi sähköposti" maxlength="40" required>
        </p>
        <p>
            <br />
            <input type="submit" name="submitPass" value="Lähetä"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='logInUser.php'" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>