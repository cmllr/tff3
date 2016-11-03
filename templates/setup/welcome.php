<?php include 'header.php'; ?>
<h2>Willkommen</h2>
<p>
    Dieses Setup-Skript installiert dir TFF3 auf deinem Webspace. Lies die Lizenz und stimme dieser Lizenz zu, um weiter zu installieren.
</p>
<pre class="gpl"><code><?= $this->view['gpl'] ?></code></pre>
<a href="?step=1" class="button button-primary">
    Einverstanden, Server prüfen
</a>
<?php
include 'footer.php';
