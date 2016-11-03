[{include file="header.html" PAGETITLE="Danis Geburtstag"}]

<article>
    <header>
        <h2>Event</h2>
        <ul class="artikelinfo">
            <li>Author: Marcel</li>
            <li>Datum: 06.12.2013</li>
        </ul>
    </header><div class="textelemente">
        Wer macht was?
        <form action="[{$PAGEROOT}]organization/add" method="post">
            <table>
                <tr>
                    <th>Element</th>
                    <th>verantwortlich</th>
                </tr>
                [{foreach from=$event_items item=row name=postings }]
                <tr>
                    <td>
                        <input type="text" name="thing[[{$row.id}]]" value="[{$row.thing}]" />
                    </td>
                    <td>
                        <input type="text" name="person[[{$row.id}]]" value="[{$row.person}]" />
                    </td>
                </tr>
                [{/foreach}]
                <tr>
                    <td><input type="text" name="thingneu" /></td>
                    <td><input type="text" name="personneu" /></td>
                </tr>
            </table>
            <input type="submit" name="speichern" value="speichern" />
        </form>
    </div>
</article>
[{include file="footer.html" }]
