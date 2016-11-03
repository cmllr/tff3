<?php include 'header.php'?>
<?php if ($this->view['albums']) : ?>
    <div class="row">
        <?php $active = _request('media', 0); ?>
        <?php foreach ($this->view['albums'] as $row => $data) : ?>
            <a class="u-pull-left" href="?media=<?php echo $data['alb_id'] ?>">
                <img src="//www.trancefish.de/web/images/album_artwork/<?= $data['artwork'] ?>" width="128" height="128" style="padding:0.5rem;margin:auto;<?php
                $data['alb_id'] == $active ? print('border:1px solid #800') : false;
                ?>"/><br/>
                     <?= $data['alb_title'] ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if ($this->view['tracks']): ?>
    <div class="row">
        <b>Tracks auf diesem Album</b>
    </div>
    <?php foreach ($this->view['tracks'] as $row => $value) : ?>
        <div class="row">
            <div class="three columns"><?= $value['song_name'] ?></div>
            <div class="three columns">
                <a href="//www.trancefish.de/web/music/<?=$value['filename']?>">
        <?= $value['filename'] ?></a>

            </div>
            <div class="three columns"><?= $value['song_genre'] ?></div>
            <div class="three columns">
                <?php if ($value['action'] == true):?>
    <audio controls>
        <source src="//www.trancefish.de/web/music/<?=$value['filename']?>" type="<?=$value['action']?>">
    </audio>
                
 <?php endif; ?>



            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php include 'footer.php'?>
