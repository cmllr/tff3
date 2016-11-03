<?php include 'header.php'?>
<p>
    Lege nun deinen Haupt-Administrator für TFF3 an. Dieser User kann anschließend im Backend weitere Unterbenutzer anlegen. Natürlich darfst Du zukünftig weitere User anlegen, dabei gibt es
    Administratoren und Redakteure.
</p>
<form action="index.php" method="post">
    <input type="hidden" name="step" value="5">
    <fieldset>
        <legend>Hauptbenutzer</legend>
        <dl>
            <dt>Dein Name:</dt>
            <dd><input type="text" name="user" placeholder="Benutzername" /></dd>
        </dl><dl>
            <dt>Dein Wunschpasswort</dt>
            <dd><input type="password" name="userpw" placeholder="Passwort" /></dd>
        </dl><dl>
            <dt>Dein Wunschpasswort noch einmal</dt>
            <dd><input type="password" name="userpwc" placeholder="Passwort" /></dd>

        </dl><dl>
            <dt>SALT:</dt>
            <dd>
                <input type="text" name="salt" value="<?= $this->view['SALT'] ?>">
            </dd>
        </dl>
        <input type="submit" class="button button-primary" value="User anlegen" />
    </fieldset>

</form>    



<?php include 'footer.php'?>