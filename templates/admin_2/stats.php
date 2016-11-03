<?php include 'adm_head.php'?>
<div class="row infobox">
    <h2>Zuletzt gemochte Beiträge</h2>
    <dl>
        <?php foreach ($this->view['votes'] as $posting => $data) : ?>

            <dt class="toprow"><?php echo $data['title'] ?></dt>
            <dd><span class="button"><?php echo $data['likes'] ?></span>
                <span class="button"><?php echo $data['time'] ?></span>
            </dd>
        <?php endforeach; ?>
    </dl>
</div>
<?php include 'adm_foot.php'?>