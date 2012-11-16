<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subgroepcategorieen_model extends CI_Model {

    function get()
    {
		// Haal alle categorieen uit de database en return als array in de juiste volgorde
		
		$this->db->order_by('volgorde','asc');
        $aAlleRecords = $this->db->get('subgroepcategorieen')->result_array();
		
		return $aAlleRecords;
    }	
}

