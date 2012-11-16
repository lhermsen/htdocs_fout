<h1>Verbanden</h1>

<?php foreach(array('Herendisputen','Damesdisputen','Herenjaarclubs', 'Damesjaarclubs') as $sSubgroep): ?>
	
	<h2><?php echo $sSubgroep; ?></h2>

	<?php foreach($aSubgroepenOpCategorie[$sSubgroep] as $aSubgroep): ?>
		
		<h3><?php echo $aSubgroep['schermnaam']; ?></h3>
		
		<div <?php if(!empty($aSubgroep['website'])): ?>onclick="window.open('<?php echo $aSubgroep['website']; ?>');"<?php endif; ?> class="verband">
		
			<?php if(!empty($aSubgroep['afbeelding'])): ?>
				<img src="<?php echo base_url('assets/images/'.$aSubgroep['afbeelding']); ?>" class="wapen" />
			<?php endif; ?>
			
			<?php if(!empty($aSubgroep['omschrijving'])): ?>
				<p class="dispuutsomschrijving"><?php echo $aSubgroep['omschrijving']; ?></p>
			<?php endif; ?>
			
		</div>
		
	<?php endforeach; ?>
	
<?php endforeach; ?>