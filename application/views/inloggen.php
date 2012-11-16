<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=136729746404515";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/md5.js"></script>
<script type="text/javascript">
if (window.location.hash == '#uitgelogd') {
	document.write('<div class="success_message">U bent succesvol uitgelogd!</div>');
	//window.location.hash = '#!';
}
else if (window.location.hash == '#nietgelinkt') {
	document.write('<div class="warning_message">Uw NoNoMes-account is niet gelinkt met uw externe account. Log anders in.</div>');
}
else if (window.location.hash == '#actief') {
	document.write('<div class="success_message">Uw account is al geactiveerd. U kunt er nu mee inloggen.</div>');
}
else if (window.location.hash == '#cookiesverlopen') {
	document.write('<div class="warning_message">Het is niet gelukt u automatisch in te loggen. Mogelijk heeft u uw inloggegevens veranderd.</div>');
}
else if (window.location.hash == '#wachtwoordreset') {
	document.write('<div class="success_message">De e-mail om uw wachtwoord te resetten is succesvol verstuurd. Open het e-mailbericht voor verdere instructies.<br />Zodra u een keer succesvol bent ingelogd met je account, vervalt de geldigheid van de reset-link (ook als u nog niet op de link hebt geklikt).</div>');
}
else if (window.location.hash == '#wwvergetenfout') {
	document.write('<div class="warning_message">U kunt niet kiezen voor de optie &quot;Wachtwoord vergeten&quot;, omdat uw account nog niet geactiveerd is, en er nog geen wachtwoord is ingesteld.<br />Bekijk uw e-mail voor de link om uw account te activeren en een wachtwoord in te stellen.</div>');
}
else if (window.location.hash == '#nonomessage') {
	document.write('<div class="info_message">Om de NoNoMessage te bekijken, dient u eerst in de loggen. Na het inloggen wordt u automatisch doorgestuurd.</div>');
}

/*
// deze functie is niet in gebruik
function workingPlaceholder() {
	var elem = document.getElementById('login').elements;
	var str='';
	for(var i = 0; i < elem.length; i++)
	{
		if (elem[i].placeholder != 'undefined' && elem[i].placeholder != null && elem[i].placeholder != '') {
			elem[i].addEventListener('click',function() { updatePlaceholder(elem[i].id, 'click'); });
			elem[i].addEventListener('onfocus',function() { updatePlaceholder(elem[i].id, 'focus'); });
			elem[i].addEventListener('onkeyup',function() { updatePlaceholder(elem[i].id, 'keyup'); });
			elem[i].addEventListener('onkeydown',function() { updatePlaceholder(elem[i].id, 'keydown'); });
		}
	} 
}
*/
<?php if (!empty($sGebruiktEmailadres)) {
	echo "window.onload = function() { updatePlaceholder('wachtwoord', 'load'); };";
}
else {
	echo "window.onload = function() { updatePlaceholder('emailadres', 'load'); };";
} ?>
</script>

<?php if(isset($bFaal)): ?>
	<div class="error_message">
		De ingevulde inloggegevens zijn onjuist.
	</div>
<?php endif; ?>

<?php if(isset($bSessieVerlopen)): ?>
	<div class="error_message">
		Het inloggen is mislukt, de inlogsessie is verlopen. Probeer het alstublieft opnieuw.
	</div>
<?php endif; ?>

<?php if(isset($bNogGeenAccount)): ?>
	<div class="warning_message">
		Uw account is nog niet geactiveerd. Bekijk uw e-mail voor de link om uw account te activeren en een wachtwoord in te stellen.
	</div>
<?php endif; ?>

<?php if(isset($bIsGestopt)): ?>
	<div class="warning_message">
		U bent gestopt met NoNoMes, helaas is het daarom niet meer mogelijk om met uw account in te loggen.
	</div>
<?php endif; ?>

<form id="login" action="<?php echo base_url(); ?>inloggen/poging" method="post" onsubmit="return encryptPass();">
    <h1>Inloggen<img src="<?php echo base_url(); ?>assets/images/icons/lock.png" alt="Versleuteld" style="border:none;vertical-align:text-bottom;cursor:help;" title="Je wachtwoord wordt op je computer versleuteld voordat deze wordt verzonden. Tevens verandert de versleuteling telkens, waardoor de verzonden gegevens maar eenmaal geldig zijn." /></h1>

    <?php

    if ($sAllowlogin > time() && $sInlogpogingen >= 6) {
 
	$aantalminutenopnieuw = floor(($sAllowlogin - time()) / 60);
	$aantalsecondenopnieuw = round((($sAllowlogin - time() / 60) - (int)($sAllowlogin - time() / 60)) * 60);
	$sInlogpogingenMv = "minuten";
	if ($aantalminutenopnieuw == 1) $sInlogpogingenMv = "minuut";
    echo "<b>Aantal inlogpogingen overschreden</b><br/>U heeft te vaak geprobeerd in te loggen met incorrecte gegevens. Probeer het over <span id=\"countdown\">".$aantalminutenopnieuw." ".$sInlogpogingenMv."</span> opnieuw.";
    echo "
	<script> 
	//<![CDATA[ 
	 var seconden=".($aantalsecondenopnieuw + 1)."
	 var minuten=".$aantalminutenopnieuw."
	
	function display(){ 
	 if (seconden<=0){ 
		seconden=60 
		minuten-=1 
	 }
	 if (minuten<=-1){ 
		seconden=0 
		minuten+=1 
	 }
	 else 
		seconden-=1
		var minutentekst='minuten'
		if (minuten == 1) {
		var minutentekst='minuut'
		}
		else if (minuten == 0 && seconden <= 1) {
    	window.location.reload();
    	}
		secondentekst = ':' + seconden;
	 	if(seconden < 10) {
	 	secondentekst = ':0' + seconden;
	 	}
		document.getElementById('countdown').innerHTML = minuten + secondentekst + \" \" + minutentekst
		setTimeout(\"display()\",1000)
	}
	display();
	//]]>
	</script> 
	";
    }
    else if ($sAllowlogin < time() || $sInlogpogingen < 6) {
		if ($sInlogpogingen >= 3) {
			$sInlogpogingenResterend = 5 - $sInlogpogingen + 1;
			if ($sInlogpogingenResterend <= 0 && $sInlogpogingen > 0) $sInlogpogingenResterend = 1;
			$sInlogpogingenTekst = "";
			if ($sInlogpogingenResterend > 1) $sInlogpogingenMv = "en";
			$sInlogpogingenTekst = "<span style=\"font-size:12px;color:#FF0000;\">U heeft nog ".$sInlogpogingenResterend." inlogpoging".$sInlogpogingenMv." over.</span>";
		}    
    ?>
    <fieldset id="inputs">
		<input type="email" name="email" id="emailadres" placeholder="E-mailadres" <?php if(!empty($sGebruiktEmailadres)) echo "value=\"".$sGebruiktEmailadres."\""; else { echo "autofocus=\"autofocus\""; } ?> required="required" onfocus="updatePlaceholder(this.id, 'focus');" onkeydown="updatePlaceholder(this.id, 'keydown');" onkeyup="updatePlaceholder(this.id, 'keyup');" onclick="updatePlaceholder(this.id, 'click');" />
		<input type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord" <?php if(!empty($sGebruiktEmailadres)) echo "autofocus=\"autofocus\""; ?> required="required" onfocus="updatePlaceholder(this.id, 'focus');" onkeydown="updatePlaceholder(this.id, 'keydown');" onkeyup="updatePlaceholder(this.id, 'keyup');" onclick="updatePlaceholder(this.id, 'click');" />
		<input type="hidden" name="wachtwoord_encrypted" id="wachtwoord_encrypted" /><input type="hidden" name="challenge" id="challenge" value="<?php echo $sChallenge; ?>" /><input type="hidden" name="response" id="response" value="<?php echo $sResponse; ?>" />
    </fieldset>
    <?php echo $sInlogpogingenTekst; ?>
    <fieldset id="actions">
    	<input type="checkbox" name="cookie" class="checkbox" value="opslaan" /> <span class="checkbox-text">Bewaar mijn inloggegevens op deze computer</span>
        <input type="submit" id="submit" value="Log in" />
        <a href="inloggen/vergeten">Wachtwoord vergeten?</a>
    </fieldset>
	
	<a href="<?php echo base_url(); ?>auth/session/facebook"><img src="<?php echo base_url(); ?>assets/images/facebook_login_button.png" style="border:0px;" /></a>
	
	<script src="http://connect.facebook.net/en_US/all.js#appId=136729746404515&amp;xfbml=1"></script>
	<div class="fb-facepile" data-max-rows="1" data-width="300"></div>

    <div style="padding-top:4px;color:#717171;font-size:12px;font-style:italic;">Bent u re&uuml;nist en wilt u graag een account?<br />Of heeft u problemen met inloggen? Mail dan naar <script type="text/javascript">document.write('website@no' + 'nomes.nl');</script>.</div>
    <?php } ?>
</form>
