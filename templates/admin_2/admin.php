<?php include 'adm_head.php'?>
<h3>Administration</h3>
<div class="infobox">
    <div class="six columns">
        <h4>Statistiken</h4>
        <hr>
        Kommentare: <span class="button"><?= $this->view['stats']['comments'] ?></span><br>
        Postings: <span class="button"><?=
            $this->
            view['stats']['postings']

            ?></span><br>
        Kategorien: <span class="button"><?=
            $this->
            view['stats']['cats']

            ?></span><br>
    </div>

    <div class="six columns">
        <h4>Aktionen</h4>
        <hr>
        <a class="button u-full-width" href="#createpage">Erstelle eine
            Seite</a><br>
        <a class="button u-full-width" href=
           "<?= $this->view['PAGEROOT'] ?>admin/blog/new">Erstelle
            einen Blogeintrag</a><br>
        <a class="button u-full-width" href="#createauthor">Erstelle einen
            "Über mich bereich"</a><br>

        <a class="button u-full-width" href="<?= $this->view['PAGEROOT'] ?>admin/purge">
            Caches leeren
        </a>
    </div>
    <hr>

    <div class="twelve columns">
        <h3>Schnellerfassung</h3>
        <hr>

        <form action=
              "<?= $this->view['PAGEROOT'] ?>admin/blog/newblog"
              enctype="multipart/form-data" method="post">
            <input class="u-full-width" name="edit_title" placeholder=
                   "Seitentitel" type="text"> 
            <textarea class="u-full-width ckeditor" cols="80" name=
                      "edit_content" placeholder="Text" rows="25">
            </textarea> <input class="button button-primary" name="go" type="submit"
                               value="Speichern">
        </form>
    </div>
    <br class="u-cf">
</div>
<!-- ENDE: Standardblock //-->
<?php include 'adm_foot.php'?>