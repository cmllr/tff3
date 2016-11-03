<?php include 'header.php'?>
<?php if (!$this->view['USER']->logged()) : ?>
    <?php include 'profile_register.php'?>
<?php endif; ?>

<?php if ($this->view['success']) : ?>
    <h3>Danke</h3>
    <p>
        Danke für deine Registrierung. Bitte rufe deine Mails ab, du hast eine Mailbestätigung erhalten. So lange diese Bestätigung nicht angeklickt wurde, bleibt dein Account inaktiv.

    </p>
<?php endif; ?>

<?php include 'footer.php'?>