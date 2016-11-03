<?php include 'header.php'?>
<?php foreach ($this->view['blogposts'] as $r => $value) : ?>
    <hr>
    <article class="blogpost">
        <h2><a href="<?php echo $value['url'] ?>">
                <?= $value['title'] ?></a>
        </h2>
        <?= $value['contents'] ?>
        <hr>Filed in:
        <?php foreach ($value['categories'] as $row => $cat) : ?>
            <a href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo $cat['url'] ?>" title="Kategorie: <?php echo $cat['title'] ?>"><?php echo $cat['title'] ?></a>,
        <?php endforeach; ?>
        <br/>
        <a class="button" href="<?php echo $value['url'] ?>?pdf=1">PDF</a>
        <?php if ($this->view['similar_posts']) : ?>
            <?php include 'blogvoter.php'?>
            <a href="https://www.paypal.me/trancefish" class="button button-primary">Kaffeespende</a>

            <?php include 'comment.php'?>
            <?php include 'plista.php'?>

        <?php endif; ?>
    </article>
    <?php if ($this->view['similar_posts']) : ?>
        <h3>Auch passend zum Thema:</h3>
        <?php foreach ($this->view['similar_posts'] as $row => $value) : ?>
            <?php if ($value['headimg'] and stristr($value['headimg'], $this->view['PAGEROOT'])): ?>
                <a href="<?= $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($value['category']) ?>/<?php echo urlencode($value['title']) ?>/">
                    <img class="u-pull-left" src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/150/50/<?= $value['headimg'] ?>" alt="<?php echo htmlspecialchars($value['title']) ?>" />
                </a>

            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endforeach; ?>
<?php if (!$this->view['show_comments']) : ?>
    <?php echo $this->view['pagelist'] ?>
<?php endif; ?>


<?php include 'footer.php'?>