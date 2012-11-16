<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documentcategorieen_model extends CI_Model {

    function get()
    {
		// Haal alle categorieen uit de database en return als array in de juiste volgorde
		
		$this->db->order_by('volgorde','asc');
        $aAlleRecords = $this->db->get('documentcategorieen')->result_array();
		
		return $aAlleRecords;
    }
	
	function wijzig_volgorde($aSleutelvolgorde)
	{
		// Wijzig de volgorde van weergave van de categorieen
		// Array aSleutelvolgorde ziet er als volgt uit: id-nummer van het record => volgordenummer
	
		foreach($aSleutelvolgorde as $iId => $iVolgordenummer)
		{
			$this->db->where('id', $iId);
			$this->db->update('documentcategorieen', array('volgorde'=>$iVolgordenummer);
		}
	}
}