[{include file="header.html" PAGETITLE='Meine Bookmarks'}]
[{if $USER->logged() }]
<form method="post" action="[{$PAGEROOT}]bookmarks/save">
    <dl><dt>Neues Bookmark</dt><dd><input type="text" name="uri" /></dd></dl>
    <input type="submit" name="save" value="save" />
</form>
[{/if}]
<ul>
    [{foreach from=$bookmarks item=row}]
    <li><a href="[{$row.uri}]" rel="nofollow" target="_blank">[{$row.uri|escape:html}]</a>[{if $USER->logged()}]<a href="[{$PAGEROOT}]bookmarks/remove/?uri=[{$row.uri}]">[x]</a>[{/if}]</li>
    [{/foreach}]
</ul>
[{include file="footer.html"}]
