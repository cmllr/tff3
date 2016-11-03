<?php include 'adm_head.php'?>
<h3>Blogadministration</h3>
<a href="<?= $this->view['PAGEROOT'] ?>admin/blog/new/" class="button button-primary">Neuer Beitrag</a>

<div class="infobox">
    <?php if ($this->view['bloglist']) : ?>
        <h2>Blogeintrag bearbeiten</h2>
        <div class="row">
            <script type="text/javascript">
                $(document).ready(function () {
                    $('table').filterTable(); // apply filterTable to all tables on this page
                });
            </script>
        </div>

        <table width="100%" class="administration_list u-full-width">
            <thead>
            <th>Titel</th>
            <th>Aktionen</th>
            </thead>
            <tbody>
                <?php foreach ($this->view['bloglist'] as $r => $row) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/edit/<?php echo $row['p_id'] ?>">
                                <?php echo $row['title'] ?>
                            </a>
                        </td>
                        <td class="u-pull-left">

                            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/edit/<?php echo $row['p_id'] ?>">
                                <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/page_edit.gif" alt=""/>
                            </a>
                            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/change_status/<?php echo $row['p_id'] ?>">
                                <?php
                                if ($row['vis'] == 1) :

                                    ?>
                                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_user_light.gif" alt="Unsichtbar"/>

                                <?php else: ?>
                                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_lock.gif" alt="Sichtbar"/>

                                <?php endif; ?>

                            </a>
                            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/disablecomments/<?php echo $row['p_id'] ?>">
                                <?php
                                if ($row['comments_allowed'] == 1) :

                                    ?>
                                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_user_dark.gif" alt="Kommentare erlaubt"/>
                                <?php else: ?>
                                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_lock.gif" alt="Kommentare verboten"/>
                                <?php endif; ?>


                            </a>
                            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/deleteblog/<?php echo $row['p_id'] ?>" onclick="return doconfirm('Wirklich löschen?')">
                                <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_delete.gif" alt="Löschen"/>

                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tr>
                <td colspan="2" class="right">
                    <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/list/<?php echo $this->view['page_prev'] ?>">
                        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_prev.gif" alt="Vorherige Seite"/>
                    </a>
                    <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/list/<?php echo $this->view['page_next'] ?>">
                        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_next.gif" alt="Vorherige Seite"/>
                    </a>

                </td>
            </tr>
        </table>
    <?php else: ?>
        Dein Blog ist komplett leer. Hinweis: Blogposts mit dem Tag <b>qload</b> werden automatisch immer geladen. Das kannst Du benutzen, um zum Beispiel deinen Footerbereich zu füllen.
    <?php endif; ?>
    <?php if ($this->view['action'] == 'editor'): ?>
        <?php if ($this->view['row']): ?>
            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/edit/<?php echo $this->view['row']['p_id'] ?>">
                <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/page_edit.gif" alt=""/>
            </a>
            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/change_status/<?php echo $this->view['row']['p_id'] ?>">
                <?php if ($this->view['row']['vis'] == 1): ?>
                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_lock.gif" alt="Sichtbar"/>
                <?php else: ?>
                    <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_user_light.gif" alt="Unsichtbar"/>
                <?php endif; ?>
            </a>
            <a href="<?php echo $this->view['PAGEROOT']; ?>admin/blog/deleteblog/<?php echo $this->view['row']['p_id'] ?>" onclick="return doconfirm('Wirklich löschen?');">
                <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_delete.gif" alt="Löschen"/>
            </a>
        <?php endif; ?>

        <form action="<?php echo $this->view['PAGEROOT']; ?><?php echo $this->view['ADMIN_ACTION'] ?>" method="post" enctype="multipart/form-data">
            <dl>
                <dt>Titel</dt>
                <dd><input type="text" name="edit_title" value="<?php echo $this->view['edit_title'] ?>" class="cms u-full-width" /></dd>
            </dl>
            <dl>
                <dt>Inhalt</dt>
                <dd>
                    <textarea class="ckeditor cms multirow" name="edit_content" id="editor" rows="50" cols="80"><?php echo htmlentities($this->view['edit_content']) ?></textarea>
                </dd>
            </dl>
            <dl>
                <dt>Tags: (CSV)
                    <?php if ($this->view['tags']) : ?>
                        <?php foreach ($this->view['tags'] as $r => $row) : ?>
                            <label class="u-pull-left">
                                <input type="checkbox" name="use_tag" value="<?php echo $row['handle'] ?>" onclick="use_this(this)"/><?php echo $row['handle'] ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dt>
                <dd>
                    <br/><input type="text" name="tags" value="<?php echo $this->view['edit_tags'] ?>" class="cms" autocomplete="false" id="tags"/>
                </dd>
            </dl>
            <dl>
                <dt>Titelbild
                </dt>
                <dd><input type="text" name="ogimage" value="<?php echo $this->view['edit_ogimage'] ?>" class="cms" autocomplete="false" />
                </dd>
            </dl>
            <dl><dt>Speichern</dt><dd>
                    <input type="submit" name="save" value="Speichern" class="button button-primary" /></dd></dl>
        </form>
        <form action="#" method="get">
            <fieldset><legend>Youtube-IMG Grabber</legend>
                <input type="text" id="yt" name="youtube_url" value="" placeholder="enter youtube url" onblur="youtube_parser()"/>
                <a href="#">
                    [check]</a>
            </fieldset>
        </form>

        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b1"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b2"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b3"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b4"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b5"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b6"/>
        <img src="<?php echo $this->view['PAGEROOT']; ?>bower_components/famfamfam-mini/dist/gif/page_video.gif" alt="yt" name="b7"/>

    <?php endif; ?>

</div>

<?php include 'adm_foot.php'?>