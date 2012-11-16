<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subgroepen_model extends CI_Model {

    function get($sCategorie = NULL)
    {
		// Zet de query om alle subgroepen van alle categorieen op te halen
		
		$this->db->order_by('volgorde','asc');
		$this->db->select('subgroepen.*, subgroepcategorieen.naam as categorie');
		$this->db->from('subgroepen,subgroepcategorieen');
		$this->db->where('subgroepen.categorie_id = subgroepcategorieen.id');
		
		// Haal alle subgroepen op uit de database
        $aSubgroepen = $this->db->get()->result_array();
		
		// Stel een array op waarin de subgroepen op categorie worden geordend
		
		foreach($aSubgroepen as $aSubgroep)
		{
			$aSubgroepenOpCategorie[$aSubgroep['categorie']][] = $aSubgroep;
		}
		
		// Mislukt? Return false
		if(empty($aSubgroepenOpCategorie)) return false;
		
		// Return de array met subgroepen
		return $aSubgroepenOpCategorie;
    }	
}