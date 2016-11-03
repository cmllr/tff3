<?php $this->view['PAGETITLE'] = 'Fitness-Log' ?>
<?php include 'header.php'?>
<div class="row">
    <div class="nine columns">
        <h1>Übersicht über deine Fitness-Aktivitäten</h1>
        <form action="<?= $this->view['PAGEROOT'] ?>fitness/save" method="post">
            <table class="u-full-width">
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Tätigkeit</th>
                        <th>Dauer (hh:mm:ss)</th>
                        <th>km</th>
                        <th>kcal</th>
                        <th>Datum</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$this->view['activities']): ?>
                        <tr>
                            <td colspan="7">
                                Leider sind noch keine Aktivitäten eingetragen
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($this->view['USER']->logged()) : ?>
                        <tr>
                            <td>Neu: </td>
                            <td><input type="text" size="5" name="what" /></td>
                            <td><input type="text" size="5"  name="length" /></td>
                            <td><input type="text" size="5"  name="km" /></td>
                            <td><input type="text" size="5"  name="kcal" /></td>
                            <td><input type="text" size="5"  name="datum" /></td>
                            <td><input type="submit" value="Speichern" name="save"/></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </diV>
    <div class="three columns">
        <div>
            <h3>Statistiken</h3>
            <?= $this->view['kcalweek'] ?> kcal / Woche <?= $this->view['week'] ?> - <?= $this->view['jahr'] ?>
            <form action="<?= $this->view['PAGEROOT'] ?>fitness/read" method="get">
                <label>
                    Woche
                    <select name="week"><?= $this->view['options_wochenliste'] ?></select>
                </label>
                <label>
                    Jahr
                    <input type="text" name="year" size="4" value="<?= $this->view['jahr'] ?>"/>
                </label>
                <input type="submit" value="Zeitraum wählen" name="go" />

            </form>
        </div>
        <div>
            <h3>Grafische Übersicht</h3>
            <img src="<?= $this->view['PAGEROOT'] ?>fitness/img/<?= $this->view['jahr'] ?>/<?= $this->view['week'] ?>" alt="Statistiken"/>
        </div>
    </div>
</div>
<?php include 'footer.php'?>
