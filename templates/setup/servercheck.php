<?php include 'header.php'; ?>
<h2>Serverprüfung</h2>
<p>
    Das Setup-Programm wird dir angezeigt, im Grunde heißt das schon, dass die minimalen Bedingungen zutreffen. Dennoch müssen wir einige kleine Prüfungen machen, die sicherstellen
    sollen, dass zum Beispiel Umlaute nicht aussehen wie Kraut und Rüben und dass die Performance des Frameworks einigermaßen fix ist.</p>
<p>
    Du siehst hier unten eine Liste. Behebe alle Punkte, die rot angehakt sind. Du kannst diese Seite immer wieder neu aufrufen, entweder mit Reload oder aber auch indem du auf den Button
    klickst, der eine erneute Prüfung durchführt. Falls alles grün ist, kannst du auf den Weiter-knopf klicken.
</p>
<table><thead><tr><th>Anforderung</th><th>Erfüllt?</th><th>Hinweise</th></tr></thead><tbody>
        <?php $x = 0; ?>
        <?php foreach ($this->view['spec'] as $key => $value) : ?>
            <tr><td><?= $key ?></td>
                <td>
                    <?php if ($value == false) : ?>
                        <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/action_stop.gif" alt="Anforderung nicht erfüllt"/>
                    <?php else: ?>
                        <img src="<?= $this->view['PAGEROOT'] ?>bower_components/famfamfam-mini/dist/gif/action_go.gif" alt="Anforderung erfüllt"/>
                    <?php endif; ?>


                </td>
                <td>
                    <?= $this->view['hint'][$x] ?>
                    <?php $x++ ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <tbody></table>
<?php if ($this->view['recheck']): ?>
    <a href="?step=1" class="button button-primary">Noch einmal prüfen</a>
<?php else: ?>
    <a href="?step=2" class="button button-primary">Weiter, Datenbank einrichten</a>

<?php endif; ?>
<?php include 'footer.php'; ?>