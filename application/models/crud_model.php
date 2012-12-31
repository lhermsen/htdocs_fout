<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	var $sTable;
	var $aDatabase = array();
		
	function set($sValue, $sKolom = 'id')
	{		
		// Haal alle data uit de database en zet de vars
		
		$this->db->where($sKolom, $sValue);
		$this->aDatabase = $this->db->get($sTable)->row_array();
		
		// Kijk of het is gelukt een rij op te halen
		if(empty($this->aDatabase)) return false;
		
		return true;
	}
	
	function nieuw($aGegevens)
	{
		// Voeg de nieuwe subgroep toe aan database
		if(!$this->db->insert($sTable,$aGegevens)) return false;
		
		return true;
	}
	
	function wijzig($aGegevens)
	{
		// Wijzig in database en return true bij succes
		
		$this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->update($sTable, $aGegevens)) return false;
		return true;
	}
	
	function verwijder()
	{
		// Verwijder uit database en return true bij succes
		
		this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->delete($sTable)) return false;
		return true;
	}
}