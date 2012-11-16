<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_model extends CI_Model {
	
	var $aDatabase = array();
	
    function __construct($iId)
    {
		if(!set($iId)) return false;
    }
	
	function set($iId)
	{
		// Haal alle data van deze id uit de database en zet de vars
		$this->aDatabase = $this->db->get_where('documenten',array('id'=>$iId))->row_array();
		
		// Kijk of het is gelukt een rij op te halen
		if(empty($this->aDatabase['id'])) return false;
		return true;
	}
	
	function uploaden()
	{
		
	}
}

