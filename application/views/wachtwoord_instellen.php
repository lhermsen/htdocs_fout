<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/md5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/security.js"></script>
<script type="text/javascript">
window.onload = function() { updatePlaceholder('wachtwoord', 'load'); };
</script>

<?php if($bFaal != false): ?>
	<div class="error_message">
		Vul een wachtwoord in van minimaal 6 tekens.
	</div>
<?php endif; ?>

<form id="login" action="<?php echo base_url(); ?>inloggen/updatewachtwoord" method="post" onsubmit="return encryptHashPass();">
    <h1>Wachtwoord instellen<img src="<?php echo base_url(); ?>assets/images/icons/lock.png" alt="Versleuteld" style="border:none;vertical-align:text-bottom;cursor:help;" title="Je wachtwoord wordt op je computer versleuteld voordat deze wordt verzonden." /></h1>
    <span style="line-height:25px;">Hallo <?php echo $sVoornaam; ?>,<br />Kies een wachtwoord om uw account aan te maken.</span>
    <fieldset id="inputs">
		<input type="hidden" name="encrypted_id" value="<?php echo $sCode; ?>" />
		<input type="text" id="emailadres" value="<?php echo $sEmail; ?>" disabled="disabled" style="margin-bottom:0px;" />
		<input type="password" name="wachtwoord" id="wachtwoord" autofocus="autofocus" placeholder="Wachtwoord" required="required" onfocus="updatePlaceholder(this.id, 'focus');" onkeydown="updatePlaceholder(this.id, 'keydown');" onkeyup="updatePlaceholder(this.id, 'keyup');" onclick="updatePlaceholder(this.id, 'click');" />
		<input type="password" name="wachtwoord_confirm" id="wachtwoord_confirm" autofocus="autofocus" placeholder="Herhaal wachtwoord" required="required" onfocus="updatePlaceholder(this.id, 'focus');" onkeydown="updatePlaceholder(this.id, 'keydown');" onkeyup="updatePlaceholder(this.id, 'keyup');" onclick="updatePlaceholder(this.id, 'click');" />
    	<input type="hidden" name="wachtwoord_hash" id="wachtwoord_hash" /><input type="hidden" name="wachtwoord_encryptedhash" id="wachtwoord_encryptedhash" /><input type="hidden" name="challenge" id="challenge" value="<?php echo $sChallenge; ?>" /><input type="hidden" name="response" id="response" value="<?php echo $sResponse; ?>" />
    </fieldset>
    <span style="font-size:12px;font-style:italic;color:#717171;">Uw wachtwoord wordt versleuteld opgeslagen.<br />Uw e-mailadres wijzigen kan nadat u het account heeft aangemaakt.</span> 
    <fieldset id="actions" style="margin-top:10px;">
        <input type="submit" id="submit" value="Stel wachtwoord in">
    </fieldset>
</form>
