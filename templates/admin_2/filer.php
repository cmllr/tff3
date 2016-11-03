<?php include 'adm_head.php'?>
<h3>Dateimanager</h3>
<div id="show_preview">
    <img src="#">
</div>

<div class="infobox">
    <form action="<?php echo $this->view['PAGEROOT']; ?>admin/filer/upload"
          method="post" enctype="multipart/form-data" class="white_bg">
        <dl>
            <dt>Starte Upload</dt>
            <input type="file" name="newfile[]" multiple="true"/>
            <input type="submit" value="Beginne Upload" name="upload" class="button button-primary"/>
            </dd>
            <dd>
                <img id="thumbnil" style="width:100px" class="u-pull-left"/>
            </dd>
        </dl>
    </form>
</div><hr>
<div class="infobox">
    <?php if (isset($this->view['files'])) : ?>
        <?php foreach ($this->view['files'] as $r => $row) : ?><div class="row">

            <?php if (stristr($row['icon'], '.jpg') || stristr($row['icon'], '.gif') || stristr($row['icon'], '.png')) : ?>
                <a href="#<?= $r ?>" class="file_dialog" data-src="<?= $r ?>" jcontent="<?php echo $row['usage'] ?>">
                    <img class="preview" src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/64/64/<?php echo $row['icon'] ?>" alt="<?php echo $row['filename_info'] ?>" class="file_content" data-src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/500/300/<?php echo $row['icon'] ?>" data-src-2="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/1000/600/<?php echo $row['icon'] ?>" />
                    <?php echo $row['icon'] ?>                    
                </a>
            <?php else: ?>
                <a href="#<?= $r ?>" class="inf u-pull-left file_dialog" data-src="<?= $r ?>">
                    <img src="<?php echo $this->view['PAGEROOT'] ?>templates/resources/icons/application_view_detail.png"  alt="<?php echo $row['filename_info'] ?>" class="file_content">
                </a>
            <?php endif; ?>
    
    </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>Info</h3>
        <p>Keine Dateien hinterlegt.</p>
    <?php endif; ?>

    <br style="clear:both"/>
</div>
<?php include 'adm_foot.php'?>