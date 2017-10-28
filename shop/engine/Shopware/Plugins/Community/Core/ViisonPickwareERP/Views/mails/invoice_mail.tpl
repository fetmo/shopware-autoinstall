Sehr geehrte{if $userSalutation eq "mr"}r Herr{elseif $userSalutation eq "ms"} Frau{/if} {$userFirstName} {$userLastName},

im Anhang dieser E-Mail finden Sie die Rechnung zu Ihrer Bestellung (Nummer: {$orderNumber}) bei {config name=shopName}.

Mit freundlichen Grüßen,
Ihr Team von {config name=shopName}

