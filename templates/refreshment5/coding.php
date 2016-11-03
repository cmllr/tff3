[{include file="header.html" title="Code Library"}]
<p>
    Hier eine kleine Bibliothek mit Codeschnipseln für jede Gelegenheit, aufgeteilt nach Themengebiet.
</p>
<ul class="code_genre">
    [{foreach from=$genres item=row name=Genres}]
    <li><a href="[{$PAGEROOT}]coding/examples/[{$row.genre|escape:url}]">[{$row.genre}]</a></li>
    [{/foreach}]
</ul>
<div class="code_examples">
    [{foreach from=$examples item=row }]
    <dl>
        <dt><a href="[{$PAGEROOT}]coding/view/[{$row.title|escape:url}]">[{$row.title}]</a></dt>
        <dd>
            [{$row.description}]
            <div class="sourcecode">
                [{$row.code}]
            </div>
        </dd>
    </dl>
    [{/foreach}]
</div>
[{include file="footer.html"}]
