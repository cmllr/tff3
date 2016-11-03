<?php include 'header.php'; ?>
<h2>Willkommen</h2>
<p>
    Dieses Setup-Skript installiert dir TFF3 auf deinem Webspace. Lies die Lizenz und stimme dieser Lizenz zu, um weiter zu installieren. Wir benötigen hier ein paar Composer-Pakete und einige Bower-Pakete. Insofern stelle bitte sicher, dass du vorher
    diese beiden Statements ausgeführt hast.
</p>
<code>
  $ bower update;<br/>
  $ composer update;
</code>
<p>
  Der ganze Murks ist unter einer GPL3-Lizenz verfügbar. Zumindest ist das vorläufig die passende Lizenz für mich.
</p>
<pre class="gpl"><code><?= $this->view['gpl'] ?></code></pre>
<a href="?step=1" class="button button-primary">
    Einverstanden, Server prüfen
</a>
<?php
include 'footer.php';
