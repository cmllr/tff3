<?php include 'adm_head.php'?>
<h3>Seitenverzeichnis</h3>

<a class="button button-primary" href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/new/<?php echo urlencode($contents['category']['handle']) ?>"><b>NEUE SEITE</b>  </a>


<?php if ($this->view['pagelist']) : ?>




    <?php foreach ($this->view['pagelist'] as $r => $contents) : ?>
        <div class="infobox">
            <div class="row toprow">
                <div class="nine columns">
                    <b><?php echo $contents['category']['handle'] ?> </b><br>
                    <?php echo $contents['category']['category_description'] ?>
                </div>
                <div class="three columns">
                    <a href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/category/edit/<?php echo urlencode($contents['category']['handle']) ?>" class="u-pull-right button button-primary">
                        <img src="<?php echo $this->view['PAGEROOT']; ?>templates/resources/icons/application_form_edit.png" alt="edit" />
                    </a>

                </div>
            </div>
            <?php foreach ($contents['inhalt'] as $row => $value) : ?>
                <div class="row">
                    <div class="eight columns">
                        <?php echo $value['handle'] ?> - <?php echo $value['title'] ?>
                        <br/><input type="text" value="<?php echo $this->view['PAGEROOT'] ?>cms/<?php echo $contents['category']['handle'] ?>/<?php echo $value['handle'] ?>">

                    </div>
                    <div class="four columns">

                        <a class="button u-pull-right" onclick="return doconfirm('Wirklich löschen?')" href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/delete/<?php echo $value['p_id'] ?>">
                            <img src="<?php echo $this->view['PAGEROOT']; ?>templates/resources/icons/delete.png" alt="Löschen" />
                        </a>
                        <a class="button u-pull-right" href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/edit/<?php echo $value['p_id'] ?>">
                            <img src="<?php echo $this->view['PAGEROOT']; ?>templates/resources/icons/application_form_edit.png" alt="edit" />
                        </a>
                        <a class="button u-pull-right" href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/visible/<?php echo $value['p_id'] ?>">
                            <?php if ($value['visible'] == 1):

                                ?>
                                <img src="<?php echo $this->view['PAGEROOT']; ?>templates/resources/icons/eye.png" alt="change Visibility" />

                            <?php else: ?>
                                <img src="<?php echo $this->view['PAGEROOT']; ?>templates/resources/icons/lock.png" alt="change Visibility" />

                            <?php endif; ?>

                        </a>

                    </div><hr>
                </div>
            <?php endforeach; ?>
        </div><br>
    <?php endforeach; ?>
    <dl class="page_dir">
        <dt>
            <a
                href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/category/new">
                Neuen Ordner erstellen </a><br class="cleared" />
        </dt>
    </dl>




<?php endif; ?>
<?php if ($this->view['category_edit']) : ?>
    <form
        action="<?php echo $this->view['PAGEROOT'] ?>admin/cms/category/edit_save/"
        method="post">
        <input type="hidden" name="cat_id"
               value="<?php echo $this->view['category_edit']['cat_id'] ?>" />
        <dl>
            <dt>Ordnername</dt>
            <dd>
                <input type="text" class="cms textfeld" name="handle"
                       value="<?php echo $this->view['category_edit']['handle'] ?>" />
            </dd>
        </dl>
        <dl>
            <dt>Beschreibender Text</dt>
            <dd>
                <input type="text" class="cms textfeld" name="category_description"
                       value="<?php echo $this->view['category_edit']['category_description'] ?>" />
            </dd>
        </dl>
        <input type="submit" name="save" value="Speichern" />
    </form>



<?php endif; ?>
<?php if ($this->view['category_new']) : ?>
    <form
        action="<?php echo $this->view['PAGEROOT'] ?>admin/cms/category/new_save/"
        method="post">
        <dl>
            <dt>Ordnername</dt>
            <dd>
                <input type="text" class="cms textfeld" name="handle" value="" />
            </dd>
        </dl>
        <dl>
            <dt>Beschreibender Text</dt>
            <dd>
                <input type="text" class="cms textfeld" name="category_description"
                       value="" />
            </dd>
        </dl>
        <input type="submit" name="save" value="Speichern" />
    </form>



<?php endif; ?>
<?php if ($this->view['page_editor']) : ?>
    <div class="infobox">
        <form
            action="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/edit_save"
            method="post" enctype="multipart/form-data">
            <input type="hidden" name="p_id"
                   value="<?php echo $this->view['page_editor']['p_id'] ?>" />

            <div class="row"><div class="six columns">
                    <dl>
                        <dt>Dateiname</dt>
                        <dd>
                            <input class="u-full-width" type="text" class="cms"
                                   value="<?php echo $this->view['page_editor']['handle'] ?>"
                                   name="handle" />
                        </dd>
                    </dl>
                    <dl>
                        <dt>Ordner</dt>
                        <dd>
                            <select name="cat_id" class="u-full-width">
                                <?php foreach ($this->view['categories'] as $id => $value) : ?>



                                    <?php $checked = false;

                                    ?>
                                    <?php
                                    if ($this->view['page_editor']['cat_id'] == $id) {
                                        $checked = ' selected="true"';
                                    }

                                    ?>
                                    <option value="<?php echo $id ?>" <?php echo $checked ?>>

                                        <?php echo $value['handle'] ?>
                                    </option>


                                <?php endforeach; ?>
                            </select>
                            <?php echo $this->view['page_editor']['cat_id'] ?>
                        </dd>
                    </dl>

                </div><div class="six columns">
                    <dl>
                        <dt>Seitentitel</dt>
                        <dd>
                            <input class="u-full-width" type="text" class="cms"
                                   value="<?php echo $this->view['page_editor']['title'] ?>"
                                   name="title" />
                        </dd>
                    </dl>
                    <dl>
                        <dt>META-Keywords:</dt>
                        <dd><input type="text" name="keywords" class="u-full-width" value="<?=$this->view['page_editor']['keywords']?>"></dd>
                    </dl>
                    <dl>
                        <dt>META-Description</dt>
                        <dd>
                            <input class="u-full-width" type="text" name="description" value="<?=$this->view['page_editor']['description']?>">
                        </dd>
                    </dl>

                </div>

            </div>
            <dl>
                <dt>Inhalt</dt>
                <dd>
                    <textarea class="ckeditor cms multirow" name="contents" rows="25"
                              cols="80">
                        <?php echo htmlspecialchars($this->view['page_editor']['contents']) ?></textarea>
                </dd>
            </dl>
            <dl>
                <dt>Titelbild:
                    <?php if ($this->view['page_editor']['headimg'] != '') :

                        ?>
                        <img src="<?php echo $this->view['PAGEROOT'] ?>thumb/Img/500/500/<?php echo $this->view['page_editor']['headimg'] ?>" />
                    <?php endif; ?>


                </dt>
                <dd>

                    <input type="text" class="cms" name="headerbild_url" value="<?php echo $this->view['page_editor']['headimg'] ?>" />



                </dd>
            </dl>

            <dl>
                <dt>Seitenaktionen</dt>
                <dd>
                    <input type="submit" name="save" value="Speichern" /> <a
                        onclick="return confirm('Wirklich löschen?')"
                        href="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/delete/<?php echo $this->view['page_editor']['p_id'] ?>">
                        Seite löschen </a>
                </dd>
            </dl>
        </form>
    </div>


<?php endif; ?>
<?php if ($this->view['new_editor']) : ?>
    <div class="infobox">
        <form
            action="<?php echo $this->view['PAGEROOT'] ?>admin/cms/page/new_save"
            method="post" enctype="multipart/form-data">
            <div class="row"><div class="six columns">
                    <dl>
                        <dt>Dateiname</dt>
                        <dd>
                            <input class="u-full-width" type="text" class="cms"
                                   value="<?php echo $this->view['new_editor']['handle'] ?>"
                                   name="handle" />
                        </dd>
                    </dl>
                    <dl>
                        <dt>Ordner</dt>
                        <dd>
                            <select name="cat_id" class="u-full-width">
                                <?php foreach ($this->view['categories'] as $id => $value) : ?>



                                    <?php $checked = false;

                                    ?>
                                    <?php
                                    if ($this->view['new_editor']['cat_id'] == $id) {
                                        $checked = ' selected="true"';
                                    }

                                    ?>
                                    <option value="<?php echo $id ?>" <?php echo $checked ?>>

                                        <?php echo $value['handle'] ?>
                                    </option>


                                <?php endforeach; ?>
                            </select>
                            <?php echo $this->view['new_editor']['cat_id'] ?>
                        </dd>
                    </dl>

                </div><div class="six columns">
                    <dl>
                        <dt>Seitentitel</dt>
                        <dd>
                            <input class="u-full-width" type="text" class="cms"
                                   value="<?php echo $this->view['page_editor']['title'] ?>"
                                   name="title" />
                        </dd>
                    </dl>
                    <dl>
                        <dt>META-Keywords:</dt>
                        <dd><input type="text" name="keywords" class="u-full-width" value="<?= $this->view['page_editor']['keywords'] ?>"></dd>
                    </dl>
                    <dl>
                        <dt>META-Description</dt>
                        <dd>
                            <input class="u-full-width" type="text" name="description" value="<?= $this->view['page_editor']['description'] ?>">
                        </dd>
                    </dl>
                </div>

            </div>
            <dl>
                <dt>Inhalt</dt>
                <dd>
                    <textarea class="ckeditor cms multirow" name="contents" rows="25"
                              cols="80"><?php echo htmlspecialchars($this->view['new_editor']['contents']) ?></textarea>
                </dd>
            </dl>
            <dl>
                <dt>Seitenbild (OG-Image, Headergrafik)</dt>
                <dd>
                    <ul>
                        <li>neu hochladen: <input type="file" name="headerbild" /></li>
                        <li><input type="text" name="headerbild_url" value="<?php echo $this->view['new_editor']['headimg'] ?>" /></li>
                    </ul>

                </dd>
            </dl>
            <dl>
                <dt>Seitenaktionen</dt>
                <dd>
                    <input type="submit" name="save" value="Speichern" />
                </dd>
            </dl>
        </form>
    </div>


<?php endif; ?>
<?php include 'adm_foot.php'?>