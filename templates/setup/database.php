<?php include 'header.php'?>
<h2>Datenbank einrichten</h2>
<form action="index.php" method="post">

    <div class="row">
        <div class="six columns">
            <hr>
            <p>
                Bitte gib deine MySQL-Zugangsdaten ein.
            </p>    
        </div>
        <input type="hidden" name="step" value="2">

        <div class="six columns">
            <hr>
            <input type="text" name="servername" value="<?= $this->view['database']['servername'] ?>" placeholder="Servername" class="u-full-width"/>
            <input type="text" name="user" value="<?= $this->view['database']['user'] ?>" placeholder="User" class="u-full-width"/>
            <input type="text" name="database" value="<?= $this->view['database']['database'] ?>" placeholder="Datenbankname" class="u-full-width"/>
            <input id="p1" type="password" name="password" value="" placeholder="Password" class="u-full-width"/>
            <?php if (!$this->view['DBsuccess']): ?>
                <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/action_stop.gif" id="checker" alt="Noch nicht konnectiert"/>
            <?php else: ?>
                <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/action_go.gif" id="checker" alt="Läuft"/>
            <?php endif; ?>
        </div>



    </div><hr>
    <div style="text-align: center">

        <input type="submit" class="button button-primary" value="Check!" />
    </div>

</form>


<?php include 'footer.php'?>