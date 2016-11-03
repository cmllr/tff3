<?php include 'header.php'?>
<p>
    Bitte kopiere diesen Inhalt in eine Text-Datei. Diese Datei musst du config.ini.php nennen und per FTPS in den Ordner <kbd>ini</kbd> hochladen. Sobald du dies getan hast, klicke auf den Button unten
</p>

<textarea rows="80" cols="100" class="u-full-width" style="height:75rem">
<?=$this->view['INI']?>
</textarea>
<p>Ich habe meine INI-Datei nun hochgeladen und möchte die <a class="button button-primary" href="?step=7">Installation fortsetzen</a></p>



<?php include 'footer.php'?>