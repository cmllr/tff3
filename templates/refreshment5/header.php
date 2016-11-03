<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'meta.php'?>
</head>
<body>
<div class="container">
    <h1 class="mainLogo">                    <?= $this->view['PAGETITLE'] ?></h1>
    <div class="mainmenu">

        <form action="<?php echo $this->view['PAGEROOT'] ?>search/" method="get" class="u-pull-right">
            <input id="iQ" name="q" placeholder="Suche..." type="text">
            <input name="go" type="submit" value="go">
        </form>
        <?php include 'menu.php'?>
    </div>


</div>
<?php include 'teasers.php'?>
<?php if ($this->view['OGIMAGE']) : ?>
    <div class="row">
        <div class="twelve columns blogteaser">
            <img class="u-full-width"
                 src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/1000/300/<?= $this->view['OGIMAGE'] ?>"
                 alt="<?= $this->view['PAGETITLE'] ?>"/>
        </div>

    </div>
<?php endif; ?>
<div class="container">