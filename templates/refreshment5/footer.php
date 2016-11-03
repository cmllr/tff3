</div>
<div class="container">
    <?php include 'share.php'?>
</div>
<div class="container">
    <?php if (!$this->view['USER']->logged()) : ?>
        <form action="<?php echo $this->view['PAGEROOT'] ?>profile/login" method="post">
            <input type="text" name="uname" placeholder="Benutzername"/>
            <input type="password" name="upass" placeholder="Passwort"/>
            <input type="submit" value="Login" name="login"/>
        </form>
    <?php else: ?>

        <a href="<?php echo $this->view['PAGEROOT'] ?>profile/logout">Logout</a>
        <?php if ($this->view['USER']->get_level() == 1): ?>
            <a href="<?php echo $this->view['PAGEROOT'] ?>admin/">Admin</a>
        <?php endif; ?>
    <?php endif; ?>

</div>

<footer>
    <div class="row">
        <?php foreach ($this->view['quickload'] as $row => $value) : ?>
            <div class="three columns">
                <b><?php echo $value['title'] ?></b>
                <?php echo $value['contents'] ?>
            </div>
        <?php endforeach; ?>
    </div>
</footer>

<script type="text/javascript">
    var WEBROOT = '<?php echo $this->view['PAGEROOT'] ?>';
    /*I need ths */
</script>


<script type="text/javascript" src="<?= $this->view['PAGEROOT'] ?>bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="<?= $this->view['PAGEROOT'] ?>js/tff<?= TFF_MINIFY ? '.min' : '' ?>.js"></script>


</body>
</html>
