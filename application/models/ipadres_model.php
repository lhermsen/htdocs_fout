<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ipadres_model extends CI_Model {
	
	var $aIpadres = array();
	
	function __construct()
	{
		parent::__construct();
		
		$this->get();
	}
	
	function insert()
	{
		// Zet het ipadres in de database
		$this->db->insert('ipadressen',array('ipadres'=>$this->input->ip_address()));
		
		// Haal de gegevens op uit de database van de row
		$this->get();
	}
	
	function get()
	{
		// Haal het record op dat hoort bij dit IP-adres
		$this->aIpadres = $this->db->get_where('ipadressen',array('ipadres'=>$this->input->ip_address()))->row_array();
	}
	
	function is_geblokkeerd()
    {
		// Check of dit ip adres geblokkeerd is volgens de tabel inlogpogingen en return true/false
		
		if(!empty($aIpadres))
		{
			$iTijdstipBlokkeringOpheffen = $this->aIpadres['tijdstip_geblokkeerd'] + $this->config->item('iAantalSecondenBlokkeren');
		
			if(time() < $iTijdstipBlokkeringOpheffen) return true; // Geblokkeerd als nu eerder is dan het moment waarop de blokkering opgeheven wordt
		}
		
		return false;
    }
	
	function berisp()
	{
		if(empty($aIpadres)) $this->insert();
		
		// Checken of het limiet wordt bereikt als dit ipadres wordt berispt
		if(($this->aIpadres['berispingen']+1) == $this->config->item('iLimietBerispingen')) 
		{
			// Blokkeren en berispingen resetten
			
			$this->db->where('ipadres', $this->input->ip_address());
			$this->db->update('ipadressen', array('tijdstip_geblokkeerd'=>time(), 'berispingen' => 0));
		}
		else
		{
			// Zet het aantal berispingen +1
			
			$this->db->where('ipadres', $this->input->ip_address());
			$this->db->update('ipadressen', array('berispingen'=>($this->aIpadres['berispingen']+1)));
		}
		
		// Return het huidige nieuwe berispingen
		
		$this->get();
		return $this->aIpadres['berispingen'];
	}
	
	function nog_geblokkeerd()
	{
		if(!empty($aIpadres))
		{
			// Uitrekenen hoelang nog geblokkeerd
		
			$iAlGeblokkeerd = time() - $this->aIpadres['tijdstip_geblokkeerd'];
			$iNogGeblokkeerd = $this->config->item('iAantalSecondenBlokkeren') - $iAlGeblokkeerd;
			
			// Return hoelang nog geblokkeerd in seconden
			return $iNogGeblokkeerd;
		}
	}
}