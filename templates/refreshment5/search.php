<?php include 'header.php'?>
<?php if ($this->view['result']): ?>
    <ul>
        <?php foreach ($this->view['result'] as $r => $row) : ?>
            <li><a href="<?php echo $row['url'] ?>/"><?php echo $row['title'] ?></a>
                <?= $row['content'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    Leider hat deine Suche nach <?php echo $this->view['suchbegriff'] ?> kein Ergebnis geliefert. Das ist ja doof. Aber tröste dich, es gibt hier noch viel mehr zu sehen.
<?php endif; ?>
<?php include 'footer.php'?>
