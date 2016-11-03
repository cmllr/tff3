[{if $Fail }]
Bei deiner Registrierung ist ein Fehler aufgetreten. Bitte prüfe, ob dein Password stimmt, ob der Username stimmt und es kann natürlich auch sein,
dass der User bereits existiert.
[{/if}]
<form action="[{$PAGEROOT}]profile/register" method="post" enctype="multipart/form-data">
    <h2>
        Registriere dich kostenlos.
    </h2>
    <fieldset>
        <legend>
            Userdaten
        </legend>
        <dl>
            <dt>
                Emailadresse:
            </dt>
            <dd>
                <input class="textfeld" placeholder="Emailadresse" name="email" />
            </dd>
        </dl>
        <dl>
            <dt>
                Vorname / Nachname:
            </dt>
            <dd>
                <input class="textfeld" name="vorname" placeholder="vorname" />
                <input class="textfeld" name="nachname" placeholder="nachname"/>
            </dd>
        </dl>
        <dl>
            <dt>
                Emailadresse bestätigen:
            </dt>
            <dd>
                <input class="textfeld" placeholder="Emailadresse" name="emailc" />
            </dd>
        </dl>
        <dl>
            <dt>
                Geschlecht:
            </dt>
            <dd>
                <select name="gender">
                    <option value="m">Männlich</option>
                    <option value="f">Weiblich</option>
                    <option value="s">Sonstiges</option>
                </select>
            </dd>
        </dl>
        <dl>
            <dt>
                Geburtsdatum:
            </dt>
            <dd>
                <input class="textfeld" name="birthday_dd" placeholder="tt"/>
                <input class="textfeld" name="birthday_mm" placeholder="mm"/>
                <input class="textfeld" name="birthday_yy" placeholder="yyyy"/>
            </dd>
        </dl>
        <dl>
            <dt>
                Passwort:
            </dt>
            <dd>
                <input type="password" placeholder="Passwort" name="pw" />
            </dd>
        </dl>

        <dl>
            <dt>
                Passwort prüfen:
            </dt>
            <dd>
                <input type="password" placeholder="Passwort" name="pwc" />
            </dd>
        </dl>
        <input type="submit" name="Registrieren!" />

    </fieldset>

</form>
