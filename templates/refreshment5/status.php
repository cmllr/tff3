<?php include 'header.php'?>
<?php if ($this->view['USER']->logged()) : ?>
    <form action="<?php echo $this->view['PAGEROOT'] ?>status/new" method="post">
        <div class="row">
            <textarea rows="8" cols="64" name="status" maxlength="150" placeholder="Schreib doch was"></textarea>
            <br/><input type="submit" name="save" value="post" />
        </div>
    </form>
<?php else: ?>
    <div class="row">
        <div class="one-half column">
            <h3>TimeLiner</h3>
            <p>
                TimeLiner ist ein Tool, bei dem du einfache, kleine Nachrichten posten darfst. Diese Nachrichten sind 150 Zeichen lang und können von deinen
                Mitlesern erneut geteilt oder auch kommentiert werden. Im Gegensatz zu einem bekannten sozialen Netzwerk steht hier aber die Kommunikation
                untereinander im Hintergrund. Teile dich einfach mit und genieße die Show.
            </p>
        </div>
        <div class="one-half column">
            <?php include 'profile_register.php'?>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->view['TIMELINE']): ?>
    <?php foreach ($this->view['TIMELINE'] as $row => $value) : ?>
        <div class="row">
            <div class="three columns">
                <img src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/64/64/<?php echo $value['author_img'] ?>" alt="<?php echo $value['author_name'] ?>" />
            </div>
            <div class="six columns">
                <h3><?php echo $value['author_name'] ?></h3>
                <div class="statusmessage">
                    <?php echo $value['statusmessage'] ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php
include 'footer.php';
