<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Documenten_model extends CI_Model {

    function get($iCategorie = null)
    {
        if($iCategorie != null) $this->db->where('categorie_id',$iCategorie);
		$this->db->order_by('volgorde','asc');
        $aAlleRecords = $this->db->get('documenten')->result_array();
		
		return $aAlleRecords;
    }
	
	function wijzig_volgorde($aSleutelvolgorde)
	{
		// Wijzig de volgorde van weergave van de documenten
		// Array aSleutelvolgorde ziet er als volgt uit: id-nummer van het record => volgordenummer
	
		foreach($aSleutelvolgorde as $iId => $iVolgordenummer)
		{
			$this->db->where('id', $iId);
			$this->db->update('documenten', array('volgorde'=>$iVolgordenummer);
		}
	}
}