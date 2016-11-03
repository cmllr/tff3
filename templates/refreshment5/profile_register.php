<h3>Registrieren</h3>
<form action="<?php echo $this->view['PAGEROOT'] ?>profile/register" method="post">
    <dl><dt>
            Email:</dt><dd> <input type="text" name="email" value="<?php echo _request('email',
    '')
?>" <?php echo $this->view['check_mail'] ?> /></dd>
        <dt>Passwort:</dt><dd> <input type="password" name="pw" value="<?php echo _request('pw',
                                   '')
?>" <?php echo $this->view['check_pw'] ?> /></dd>
        <dt>Passwort bestätigen:</dt><dd> <input type="password" name="pwc" value="<?php echo _request('pwc',
                                                     '')
?>" <?php echo $this->view['check_pw'] ?> /></dd></dl>
    <input type="submit" value="registrieren" />
</form>
