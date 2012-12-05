<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taken_model extends CI_Model {

    function get()
    {
		// Sorteer op datum en tijd, de taken van binnenkort eerst, daarna de taken van later
		
		$this->db->order_by('date(begin)', 'asc');
		$this->db->order_by('time(begin)', 'asc');
		
		// Selecteer alle taken met het begin later dan nu of het einde later dan nu (voor taken die nú zijn, maar nog niet zijn afgelopen)
		$this->db->where("begin > NOW() OR einde > NOW()");
		
		// Haal de taken op uit de database
        $aTaken = $this->db->get('taken')->result_array();
		
		// Mislukt? Return false
		if(empty($aTaken)) return false;
		
		// Return de array met taken
		return $aTaken;
    }	
	
	function get_oud($iLimitBegin, $iLimitEinde)
	{
		// Haal de oude taken op uit de database. Sorteer op datum en tijd.
		
		$this->db->order_by('date(begin)', 'asc');
		$this->db->order_by('time(begin)', 'asc');
		
		// Selecteer alle taken met het einde eerder dan nu
		$this->db->where("einde < NOW()");
		
		// Selecteer slechts een bepaald aantal taken uit het verleden
		$this->db->limit($iLimitBegin,$iLimitEinde);
		
		// Haal de oude taken op uit de database
        $aOudeTaken = $this->db->get('taken')->result_array();
		
		// Return de array met taken
		return $aOudetaken;
	}
}