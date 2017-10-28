{include file="string:{config name=emailheaderplain}"}

Sehr geehrte{if $supplier.salutation == 'mr'}r Herr{else} {if $supplier.salutation == 'ms'}Frau{/if}{/if} {if $supplier.contact}{$supplier.contact}{else}{$supplier.name}{/if},

bitte um Lieferung der im Anhang aufgeführten Artikel.

{include file="string:{config name=emailfooterplain}"}