<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gebruikers_model extends CI_Model {
    
	function get($sSubgroepNaam = '', $bSubgroepBuitensluiten = false)
	{
		// Haal eerst eventueel de subgroep op met de gegeven naam
		if(!empty($sSubgroepNaam)) $aSubgroep = $this->db->get_where('subgroepen',array('naam'=>$sSubgroepNaam))->row_array();
		
		// Haal nu alle gebruikers op, eventueel alleen van de geselecteerde subgroep (of als de subgroep buitengesloten moet worden, alle gebruikers BEHALVE die van betreffende subgroep)
		
		if(!empty($aSubgroep['id']))
		{
			if($bSubgroepBuitensluiten) $this->db->where('subgroep_id !=', $aSubgroep['id']);
			else $this->db->where('subgroep_id', $aSubgroep['id']);
		}
		$aGebruikers = $this->db->get('gebruikers')->result_array();
		
		return $aGebruikers;
	}
	
	function exporteer($aIdsGebruikers)
    {
        // Kijk naar welke gebruiker is ingelogd. Is dat een reunistbeheerder of een ledenbeheerder? Een reunistbeheerder mag max 50 actieve leden exporteren. En andersom.
		
		// Exporteerde gegevens van alle gebruikers waarvan het id in de gegeven array staat naar een excel bestand.
		
    }	
}

