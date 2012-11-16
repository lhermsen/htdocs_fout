<script type="text/javascript">
window.onload = function() { updatePlaceholder('wachtwoord', 'load'); };
</script>

<?php if($bFaal != false): ?>
	<div class="error_message">
		Dit e-mailadres komt niet voor in de database. Probeer opnieuw.
	</div>
<?php endif; ?>

<form id="login" action="<?php echo base_url(); ?>inloggen/vergeten" method="post">
    <h1>Wachtwoord vergeten</h1>
    <span style="line-height:25px;">Vul uw e-mailadres in, en u ontvangt een e-mail met een link om uw wachtwoord te resetten.</span>
    <fieldset id="inputs">
		<input type="text" id="emailadres" name="email" value="" autofocus="autofocus" placeholder="E-mailadres" required="required" onfocus="updatePlaceholder(this.id, 'focus');" onkeydown="updatePlaceholder(this.id, 'keydown');" onkeyup="updatePlaceholder(this.id, 'keyup');" onclick="updatePlaceholder(this.id, 'click');" />
    </fieldset>
    <span style="font-size:12px;font-style:italic;color:#717171;">De geldigheid van de reset-link vervalt zodra er een keer succesvol met het betreffende account is ingelogd.</span> 
    <fieldset id="actions" style="margin-top:10px;">
        <input type="submit" id="submit" value="Reset wachtwoord">
        <a href="../inloggen">&laquo; Terug naar inlogvenster</a>
    </fieldset>
</form>
