<!-- alles wat iedere pagina aan de bovenkant moet hebben staan, boven de /head-tag. Eindig deze view net voor de /head-tag. Wanneer bepaalde pagina’s iets nodig hebben uit het head gedeelte, kan dit dus nog na deze view geladen worden. -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
	<head>
<!-- 
*******************************************************
**  Copyright 2012 Lucas Hermsen & Thomas Hoornstra  **
**   Niets van deze website mag zonder voorafgaande  **
**     schriftelijke toestemming voor doeleinden     **
**     buiten de NoNoMes-website worden gebruikt.    **
*******************************************************
-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta property="og:title" content="Studentenvereniging NoNoMes - S.V.A.A. Nomen Non Magnum Est" />
		<meta property="og:url" content="http://www.nonomes.nl" />
		<meta property="og:image" content="http://a4.sphotos.ak.fbcdn.net/hphotos-ak-ash4/390578_325650684119479_325649944119553_1229741_883568779_n.jpg" />
		<meta property="og:site_name" content="Studentenvereniging NoNoMes - S.V.A.A. Nomen Non Magnum Est" />
		<meta property="fb:admins" content="1185723499" />
		<title>Studentenvereniging NoNoMes - S.V.A.A. Nomen Non Magnum Est</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
		<!-- CSS -->
		<link href="<?php echo base_url(); ?>assets/css/struktuur.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url(); ?>assets/css/opmaak.css" rel="stylesheet" type="text/css" />
		<!-- <link href="<?php /* nc_get_cp_css_directory(); */ ?>" rel="stylesheet" type="text/css" media="screen" /> -->
		<!-- JS -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/csspopup.js"></script>
<?php if(isset($sHeaderData)):
	echo $sHeaderData;
endif; ?>

		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-15547053-4']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
