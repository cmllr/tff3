<dl>
    <dt>
        Geschlecht:
    </dt>
    <dd>
        <select class="u-full-width" name="gender">
            <option value="m" <?= $this->view['preselected'][0] == 'm' ? ('selected="selected"')
        : false
?>>Mann</option>
            <option value="f" <?= $this->view['preselected'][0] == 'f' ? ('selected="selected"')
                            : false
?>>Frau</option>
        </select>
    </dd>
</dl>
<dl>
    <dt>
        Stimmalter:
    </dt>
    <dd>
        <select class="u-full-width" name="age">
            <option value="k" <?= $this->view['preselected'][1] == 'k' ? ('selected="selected"')
                            : false
?>>Kind (-12 Jahre)</option>
            <option value="j" <?= $this->view['preselected'][1] == 'j' ? ('selected="selected"')
                            : false
?>>Jugendlich (- 25 Jahre)</option>
            <option value="e" <?= $this->view['preselected'][1] == 'e' ? ('selected="selected"')
                            : false
?>>Erwachsen (-40 Jahre)</option>
            <option value="o" <?= $this->view['preselected'][1] == 'o' ? ('selected="selected"')
                            : false
?>>in den besten Jahren (-50 Jahre)</option>
        </select>
    </dd>
</dl>
<dl>
    <dt>
        Eigene Aufnahmemöglichkeit / Studio:
    </dt>
    <dd>
        <select class="u-full-width" name="studio">
            <option value="y" <?= $this->view['preselected'][2] == 'y' ? ('selected="selected"')
                            : false
?>>
                Ja
            </option>
            <option value="n" <?= $this->view['preselected'][2] == 'n' ? ('selected="selected"')
                            : false
?>>
                Nein
            </option>
        </selecT>
    </dd>
</dl>
