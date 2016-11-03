[{include file="header.html" PAGETITLE="Bookinganfrage" }]
<article>
    [{if $mailtext }]
    <h2>Danke sehr</h2>
    <p>
        Vielen Dank für Ihre Anfrage. Diese Mail hier wird an mich verschickt. Ich melde mich zeitnah
    </p>
    <pre>[{$mailtext}]
    </pre>
    [{else}]
    <header>
        <h2>Bookinganfrage formulieren</h2>
        <p>
            Sie können hier eine Bookinganfrage stellen
        </p></header>
    <form action="[{$PAGEROOT}]bookings" method="post">
        <dl class="mandatory">
            <dt>
                Ihr Name:
            </dt>
            <dd>
                <input type="text" class="textfeld" value="" name="booker_name" />
            </dd>
        </dl>
        <dl class="mandatory">
            <dt>
                Ihre Mailadresse:
            </dt>
            <dd>
                <input type="text" class="textfeld" value="" name="booker_mail" />
            </dd>
        </dl>
        <dl>
            <dt>
                Location/Club/Event:
            </dt>
            <dd>
                <input type="text" class="textfeld" value="" name="booker_location" />
            </dd>
        </dl>
        <dl>
            <dt>
                Webseite der Location:
            </dt>
            <dd>
                <input type="text" class="textfeld" value="" name="booker_location_website" />
            </dd>
        </dl>
        <dl>
            <dt>
                Ihre Webseite (falls Bookingagentur):
            </dt>
            <dd>
                <input type="text" class="textfeld" value="" name="booker_website" />
            </dd>
        </dl>
        <dl>
            <dt>
                Gewünschter Musikstil
            </dt>
            <dd>
                <select name="musicstyle">
                    <option>House</option>
                    <option>Trance</option>
                    <option>Hardstyle</option>
                    <option>Hardcore</option>
                    <option>Dubstep</option>
                    <option>Handsup</option>
                    <option>--other--</option>
                </select>
            </dd>
        </dl>
        <dl>
            <dt>
                In welchem Land ist die Location:
            </dt>
            <dd>
                <input type="radio" name="country" value="de" />
                Deutschland
                <br/>
                <input type="radio" name="country" value="ch"/>
                Schweiz
                <br/>
                <input type="radio" name="country" value="at"/>
                Österreich
                <br/>
                <input type="radio" name="country" value="uk"/>
                UK
                <br/>
                <input type="radio" name="country" value="fr"/>
                Frankreich
                <br/>
            </dd>
        </dl>
        <dl>
            <dt>
                Soll ein MC dabei sein?:
            </dt>
            <dd>
                <input name="with_mc" value="ja" type="radio"/>
                Ja
                <br/>
                <input name="with_mc" value="nein" type="radio"/>
                Nein
            </dd>
        </dl>
        <dl>
            <dt>
                Voraussichtliche Anzahl Besucher:
            </dt>
            <dd>
                <select name="booker_nov">
                    <option>zwischen 100-500</option>
                    <option>zwischen 500-1000</option>
                    <option>zwischen 1000-2000</option>
                    <option>Konzertgröße</option>
                </select>
            </dd>
        </dl>
        <dl>
            <dt>
                Weitere Infos zum Event:
            </dt>
            <dd>
                <textarea class="textfeld" rows="15" cols="80" name="additional_info"></textarea>
            </dd>
        </dl>
        <dl>
            <dt>Was steht hier in dem Bild?</dt>
            <dd><img src="[{$PAGEROOT}]captcha/image" alt=""/><input type="text" name="cap" class="textfeld"/></dd>
        </dl>
        <dl>
            <dt>
                Mail abschicken
            </dt>
            <dd>
                <input type="submit" class="sub_log" name="do_book" value="Bookinganfrage stellen" />
        </dl>
    </form>
    [{/if}]
</article>
[{include file="footer.html" }]
