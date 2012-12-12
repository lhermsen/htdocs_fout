<!-- alles wat iedere pagina aan de bovenkant moet hebben staan, onder de /head-tag. Begin deze view met de /head-tag. -->
	</head>
	<body>
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=136729746404515";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<?php /* nc_get_cp(); */ ?>
	
	
	<?php /* if($this->uri->segment(1) == 'voorpagina' && $this->input->get('close') != 1): */ ?>
	
	<?php /* if($this->uri->segment(1) == 'voorpagina' && $this->input->get('close') != 1 && $this->input->get('flyer') != 1): ?>
	
	<a href="?close=1#filmpje"><div id="blanket"></div></a>
	<div id="popupimage">
		<a href="?close=1#filmpje"><img src="<?php echo base_url(); ?>assets/images/sluiten.png" id="sluiten" name="sluiten" onmouseover="this.style.display='block'" /></a>
		<img src="<?php echo base_url(); ?>assets/images/poster_intro_2012.jpg" onmouseover="document.sluiten.style.display='block'" onmouseout="document.sluiten.style.display='none'" />
	</div>
	
	<?php endif; ?>


	<?php if($this->uri->segment(1) == 'voorpagina' && $this->input->get('flyer') == 1): ?>
	
	<a href="?close=1#filmpje"><div id="blanket"></div></a>
	<div id="popupimage">
		<a href="?close=1#filmpje"><img src="<?php echo base_url(); ?>assets/images/sluiten.png" id="sluiten" name="sluiten" onmouseover="this.style.display='block'" /></a>
		<img src="<?php echo base_url(); ?>assets/images/introflyer2012.jpg" onmouseover="document.sluiten.style.display='block'" onmouseout="document.sluiten.style.display='none'" />
	</div>
	
	<?php endif; */ ?>


		<div id="header">
			<img id="lichteffect" src="<?php echo base_url(); ?>assets/images/lichteffect.jpg" alt="Lichteffect" />
		</div>
		
		<div id="container">
			<a href="<?php echo base_url(); ?>"><img id="wapen" src="<?php echo base_url(); ?>assets/images/wapen.jpg" alt="Wapen van NoNoMes" /></a>
			<img id="nonomes" src="<?php echo base_url(); ?>assets/images/nonomes.jpg" alt="NoNoMes" />
			<!--
			<div id="poster" onclick="window.location = '?poster=1';" style="cursor:pointer;">
			<div style="margin-bottom:10px;">Kom langs bij de<br />Word Lid actie!</div>
			<img src="<?php echo base_url(); ?>assets/images/Wordlidflyer_klein.jpg" alt="Word Lid actie" />
			</div>
			-->
			<div id="navigatie">
				<img class="pijltje" alt="&laquo;" id="arrow1" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'voorpagina'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>voorpagina" style="color:#d2b23a;"<?php if($this->uri->segment(1) != 'voorpagina'): ?> onmouseover="showArrow('1');" onmouseout="hideArrow('1');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'voorpagina'): ?><strong><?php endif; ?>VOORPAGINA<?php if($this->uri->segment(1) == 'voorpagina'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow2" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'senaat'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>senaat" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'senaat'): ?>onmouseover="showArrow('2');" onmouseout="hideArrow('2');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'senaat'): ?><strong><?php endif; ?>SENAAT<?php if($this->uri->segment(1) == 'senaat'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow3" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'verbanden'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>verbanden" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'verbanden'): ?>onmouseover="showArrow('3');" onmouseout="hideArrow('3');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'verbanden'): ?><strong><?php endif; ?>VERBANDEN<?php if($this->uri->segment(1) == 'verbanden'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow4" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'societeit'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>societeit" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'societeit'): ?>onmouseover="showArrow('4');" onmouseout="hideArrow('4');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'societeit'): ?><strong><?php endif; ?>SOCI&Euml;TEIT<?php if($this->uri->segment(1) == 'societeit'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow5" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'fotos'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>fotos" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'fotos'): ?>onmouseover="showArrow('5');" onmouseout="hideArrow('5');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'fotos'): ?><strong><?php endif; ?>FOTO'S<?php if($this->uri->segment(1) == 'fotos'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow6" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'contact'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>contact" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'contact'): ?>onmouseover="showArrow('6');" onmouseout="hideArrow('6');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'contact'): ?><strong><?php endif; ?>CONTACT<?php if($this->uri->segment(1) == 'contact'): ?></strong><?php endif; ?></a><br />
				<?php if (!isset($_SESSION['gebruiker'])) { ?>
				<img class="pijltje" alt="&laquo;" id="arrow7" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'inloggen'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>inloggen" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'inloggen'): ?>onmouseover="showArrow('7');" onmouseout="hideArrow('7');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'inloggen'): ?><strong><?php endif; ?>INLOGGEN<?php if($this->uri->segment(1) == 'inloggen'): ?></strong><?php endif; ?></a><br />
				<?php } if (!isset($_SESSION['gebruiker']) || isset($_SESSION['nc_login_status'])) { ?>
				<img class="pijltje" alt="&laquo;" id="arrow8" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'lid_worden'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>lid_worden" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'lid_worden'): ?>onmouseover="showArrow('8');" onmouseout="hideArrow('8');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'lid_worden'): ?><strong><?php endif; ?>LID WORDEN?<?php if($this->uri->segment(1) == 'lid_worden'): ?></strong><?php endif; ?></a><br />
				<?php } if (isset($_SESSION['gebruiker'])) { ?>
				<img class="pijltje" alt="&laquo;" id="arrow7" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'leden'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>leden" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'leden'): ?>onmouseover="showArrow('7');" onmouseout="hideArrow('7');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'leden'): ?><strong><?php endif; ?>LEDENGEDEELTE<?php if($this->uri->segment(1) == 'leden'): ?></strong><?php endif; ?></a><br />
				<img class="pijltje" alt="&laquo;" id="arrow8" src="<?php echo base_url(); ?>assets/images/pijltje.png"<?php if($this->uri->segment(1) == 'uitloggen'): ?> style="display:inline;"<?php endif; ?> />
				<a href="<?php echo base_url(); ?>leden/uitloggen" style="color:#d2b23a;" <?php if($this->uri->segment(1) != 'uitloggen'): ?>onmouseover="showArrow('8');" onmouseout="hideArrow('8');"<?php endif; ?>>
				<?php if($this->uri->segment(1) == 'uitloggen'): ?><strong><?php endif; ?>UITLOGGEN<?php if($this->uri->segment(1) == 'uitloggen'): ?></strong><?php endif; ?></a><br />
				<?php } ?>
			</div>
			<img id="nonomesleden" src="<?php echo base_url(); ?>assets/images/leden.jpg" alt="Leden van NoNoMes" />
			<div id="ingelogd_als"><?php if (isset($_SESSION['volledige_naam'])) echo "Ingelogd als: ".$_SESSION['volledige_naam']; ?></div>
			<div id="contact">Warmoesstraat 121 // Tel: 020 - 627 3067</div>
			<div id="inhoud">
			<div style="overflow:auto;">
