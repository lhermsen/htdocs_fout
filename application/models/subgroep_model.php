<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subgroep_model extends Crud_model {
		
	public function __construct()
	{
		parent::__construct();
		$sTable = 'subgroepen';
	}
	
	function wijzig($aGegevens)
	{
		// Wijzig in database en return true bij succes
		
		$this->db->where('id', $this->aDatabase['id']);
		if($this->aDatabase['hardcoded'] != 1)
		{
			if(!$this->db->update($sTable, $aGegevens)) return false;
			return true;
		}
		return false;
	}
	
	function verwijder()
	{
		// Verwijder uit database en return true bij succes
		
		this->db->where('id', $this->aDatabase['id']);
		if($this->aDatabase['hardcoded'] != 1)
		{
			if(!$this->db->delete($sTable)) return false;
			return true;
		}
		return false;
	}
}