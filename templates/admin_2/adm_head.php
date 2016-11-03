<!doctype HTML>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Open+Sans|Oswald|Angitonymous+Pro);
        </style>

        <title>
            Administration TFF3
        </title>
        <script type="text/javascript" src="<?= $this->view['PAGEROOT'] ?>bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?= $this->view['PAGEROOT'] ?>bower_components/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?=$this->view['PAGEROOT']?>bower_components/filterTable/jquery.filtertable.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript">
            // If you got this far, I am having a problem anywayz
            var WEBROOT = '<?php echo $this->view['PAGEROOT']; ?>';
            var MEDIADIR = 'web/_media/';
            CKEDITOR.config.allowedContent = true;
            CKEDITOR.config.disallowedContent = 'img{width,height}';
        </script>
        <script type="text/javascript"
                src="<?php echo $this->view['PAGEROOT']; ?>js/adm.js">
        </script>

        <link rel="stylesheet" href="<?= $this->view['PAGEROOT'] ?>templates/skeleton/normalize.css" />
        <link rel="stylesheet" href="<?= $this->view['PAGEROOT'] ?>templates/skeleton/skeleton.css" />
        <link rel="stylesheet" href="<?= $this->view['PAGEROOT'] ?>templates/admin_2/styles.css" />

    </head>
    <body>
        <div class="row toprow">
            <div class="four columns">
                <h4> <?= $_SESSION['USERNAME'] ?></h4>
            </div>
            <div class="three columns offset-by-five u-pull-right">
                <a class="button u-pull-right" href="<?= $this->view['PAGEROOT'] ?>profile/logout">Logout</a>
                <a class="button u-pull-right" href="<?= $this->view['PAGEROOT'] ?>">Preview</a>
            </div>
        </div>
        <div class="row">
            <div class="two columns menu">
                <h3>Menu</h3>
                <hr>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/">Administration</a>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/blog/list">
                    Blogbeiträge
                </a>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/comments">
                    Kommentare
                </a>
                <hr>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/cms">
                    Contentseiten
                </a>
                <hr>

                <a href="<?php echo $this->view['PAGEROOT']; ?>admin/filer/">
                    Dateimanager
                </a>
                <hr>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/users">
                    Benutzerverwaltung
                </a>
                <hr>
                <a href="<?= $this->view['PAGEROOT'] ?>admin/ini">
                    Konfiguration
                </a>

                <a href="<?= $this->view['PAGEROOT'] ?>admin/stats">
                    Statistiken
                </a>


            </div>
            <div class="ten columns contents">
                <!-- ENDE KOPF //-->
                <!-- BEGIN: Standardblock //-->