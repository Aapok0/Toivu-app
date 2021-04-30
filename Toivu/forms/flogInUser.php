<fieldset><legend>Kirjautumistiedot</legend>
    <form name="logform" method="post">
        <p>
            Sähköposti 
            <br />
            <input type="email" name="givenEmail" placeholder="voimassa oleva sähköposti" maxlength="40" required/>
        </p>
        <p>
            Salasana
            <br />
            <input type="password" name="givenPassword" placeholder="salasana, vähintään 8 merkkiä" maxlength="20" required/>
        </p>
        <p>
            <br />
            <input type="submit" name="submitUser" value="Kirjaudu"/>
            <input type="reset" onclick="return confirmEmpty()" value="Tyhjennä"/>
            <input type="button" onclick="location.href='index.php'" value="Palaa takaisin"/>
        </p>
    </form>
</fieldset>