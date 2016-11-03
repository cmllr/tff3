<?php include 'adm_head.php'?>
<div class="row">
    <div class="six columns">
        <h3>Template wählen</h3>
        <form action="<?= $this->view['PAGEROOT'] ?>admin/templates/select" method="post">

            <select name="use_template" class="u-full-width" id="tpl_selector">
                <optgroup label="Templates">
                    <?php foreach ($this->view['templates'] as $r => $v) : ?>
                        <option value="<?= $v ?>"><?= $v ?></option>
                    <?php endforeach; ?>
                </optgroup>
            </select>
        </form></div>
    <div class="six columns">
        <h3>Vorschau</h3>
    </div>
</div>
<div class="infobox">
    <h3>Source-Code-Editor</h3>
    <textarea class="u-full-width php_code" rows="50" cols="80"><?=$this->view['CODE']?></textarea>
</div>
    
    <?php include 'adm_foot.php'?>