<?php include 'header.php'?>
<?php echo $this->view['contents'] ?>
<?php $x = 0; ?>
<?php foreach ($this->view['posts'] as $row => $value) : ?>
    <?php if ($row == 0): ?>
        <div class="row">
            <div class="first_article twelve columns" style="background-image:url(<?php echo $value['headimg'] ?>)">
                <h2>
                    <a title="<?= $value['title'] ?>" href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($value['category']) ?>/<?php echo urlencode($value['title']) ?>/">
                        <?php echo $value['title'] ?>
                    </a>
                </h2><span class="first_article_contents">
                    <?php echo $value['contents_long'] ?></span>
            </div>
        </div>
    <?php else: ?>
        <?php if ($x == 0): ?>
            <div class="row">
            <?php endif; ?>
            <div class="four columns light">
                <h3><a title="<?= $value['title'] ?>" href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($value['category']) ?>/<?php echo urlencode($value['title']) ?>/"><?= $value['title'] ?></a></h3>
                <h4><?php echo date('d.m.Y', $value['times']) ?></h4>
                <a title="<?= $value['title'] ?>" href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($value['category']) ?>/<?php echo urlencode($value['title']) ?>/">
                    <img class="thmb u-full-width" src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/<?php echo $value['w'] ?>/<?php echo $value['h'] ?>/<?php echo $value['headimg'] ?>" alt="<?php echo $value['title'] ?>"/>
                </a>
                <?= $value['contents'] ?>

                <hr/>
            </div>

            <?php ++$x; ?>
            <?php if ($x == 3) {
    $x = 0;
} ?>

            <?php if ($x == 0): ?></div><?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
<?php include 'footer.php'?>
<?php exit() ?>
