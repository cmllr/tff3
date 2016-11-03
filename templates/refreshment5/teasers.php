<?php if ($this->view['morenews']) : ?>
    <div class="container">
        <div class="row teasers">
            <?php foreach ($this->view['morenews'] as $v => $row) : ?>
                <div class="three columns">
                    <a href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo $row['categoryurl'] ?>/<?php echo $row['titleurl'] ?>/" title="<?php echo $row['title'] ?>">
                        <img class="u-full-width thmb" src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/400/150/<?php echo $row['headimg'] ?>" alt="<?php echo $row['title'] ?>"/>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
