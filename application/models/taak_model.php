<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taak_model extends CI_Model {
	
	var $aDatabase = array();
	
	function set($iId)
	{
		// Haal alle data van deze id uit de database en zet de vars
		$this->aDatabase = $this->db->get_where('taken',array('id'=>$iId))->row_array();
		
		// Kijk of het is gelukt een rij op te halen
		if(empty($this->aDatabase)) return false;
		return true;
	}
	
	function formatteer($aGegevens)
	{
		// Zet de datum en tijd in het juiste format
		
		$aGegevens['begin'] = $aGegevens['begin_jaar'].'/'.$aGegevens['begin_maand'].'/'.$aGegevens['begin_dag'].' '.$aGegevens['begin_uur'].':'.$aGegevens['begin_minuten'];
		$aGegevens['einde'] = $aGegevens['einde_jaar'].'/'.$aGegevens['einde_maand'].'/'.$aGegevens['einde_dag'].' '.$aGegevens['einde_uur'].':'.$aGegevens['einde_minuten'];

		return $aGegevens;
	}
	
	function nieuw($aGegevens)
	{
		$aGegevens = $this->formatteer($aGegevens);
	
		// Voeg de nieuwe taak toe aan database
		if(!$this->db->insert('taken',$aGegevens)) return false;
		
		return true;
	}
	
	function wijzig($aGegevens)
	{
		$aGegevens = $this->formatteer($aGegevens);
		
		// Wijzig in database en return true bij succes
		
		$this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->update('gebruikers', $aGegevens)) return false;
		return true;
	}
	
	function verwijder()
	{
		// Verwijder uit database en return true bij succes
		
		this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->delete('gebruikers')) return false;
		return true;
	}
}