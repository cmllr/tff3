<form action="<?php echo $this->view['PAGEROOT'] ?>sprecherkartei/filter" method="get">
    <h1>Sprecherkartei</h1>
    <p>
        Wir haben hier im deutschsprachigen Raum den Luxus, dass wir auf fantastische Sprecher zurückgreifen können. Teilweise klingen die deutschen Synchronsprecher sogar besser als
        das Original. Finde hier in der Sprecherkartei den passenden Sprecher für dein Thema.
    </p>
    <p>
        Bitte beachte, dass hier lediglich eine Vermittlung zwischen dir und dem Sprecher stattfindet. Ich haben also eine Liste von mehr oder weniger bekannten Sprechern gelistet, die du
        <em>
            verbindlich
        </em>
        buchen kannst. Ich verdiene an diesem Service gar nichts, ich bin auch zu keiner Zeit als Vertragspartner zu sehen: Du suchst einen Sprecher? Ich zeige dir Sprecher.
    </p>
    <h2>
        Finden Sie den Sprecher, den Sie suchen
    </h2>
    <fieldset><legend>Stimmfarbe festlegen</legend>
        <blockquote>
            Zeichnen ist Sprache für die Augen, Sprache ist Malerei für das Ohr.
            <cite>Joseph Joubert</cite>
        </blockquote>

        <dl>
            <dt>Stimmalter:</dt>
            <dd>
                <select name="alter">
                    <option value="k">Kind 4-10</option>
                    <option value="t">Teenager 11-17</option>
                    <option value="je">Junger Erwachsener 18-30</option>
                    <option value="e">Erwachsener 30+</option>
                    <option value="s">Senior</option>
                </select>
            </dd>
            <dl>
                <dt>Geschlecht</dt>
                <dd>
                    <select name="gender">
                        <option value="male">
                            Männlich
                        </option>
                        <option value="female">
                            Weiblich
                        </option>
                    </select>
                </dd>
            </dl>
    </fieldset>
    <fieldset><legend>Castingbeschreibung</legend>

        <dl>

        </dl>
    </fieldset>
</form>
