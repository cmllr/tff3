[{include file="header.html" PAGETITLE="Newsletter"}]
[{if $in_opted }]
<h2>Danke</h2>
<p>Vielen Dank.</p>
[{/if}]
[{if $errorcode}]
<h2>Fehler</h2>
<div>
    [{$errorcode}]
</div>
[{/if}]
[{if $show_info}]
<h2>Anmeldung zum Newsletter</h2>
<p>
    Vielen Dank für deine Anmeldung zum Newsletter.
    Du erhältst in Kürze eine Email mit einem Link, den Du anklicken musst,
    um deine Mailadresse und Anmeldung zu bestätigen.
    Dies muss sein, damit keiner einfach so mit deiner Mailadresse hier rumpfuscht.
</p>
[{else}]
<form action="[{$PAGEROOT}]newsletter/add" method="post">
    <input type="text" placeholder="Emailadresse" name="nl_subscribe" />
    <input type="submit" name="addme" value="Abonnieren" />
</form>
[{/if}]
[{include file="footer.html" }]
