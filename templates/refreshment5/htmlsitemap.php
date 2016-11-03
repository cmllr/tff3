<?php include 'header.php'?>


<div class="entry_content">
    <?php foreach ($this->view['sitemap'] as $r => $row) : ?>

        <dl>
            <dt><h3><a href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($r) ?>/"><?php echo $r ?></a></h3></dt>
            <dd>
                <ul>
                    <?php foreach ($row as $re => $entry) : ?>
                        <li><a href="<?php echo $this->view['PAGEROOT'] ?>blog/show/<?php echo urlencode($r) ?>/<?php echo urlencode($entry['title']) ?>/"><?php echo $entry['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>

            </dd>
        </dl>
    <?php endforeach; ?>
</div>
<?php include 'footer.php'?>
