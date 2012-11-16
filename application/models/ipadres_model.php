<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ipadres_model extends CI_Model {

	var $aIpadres = array();
	
	function $this->refresh()
	{
		// Haal het record op dat hoort bij dit IP-adres
		
		$this->aIpadres = $this->db->get_where('ipadressen',array('ipadres'=>$this->input->ip_address()))->row_array();
	}
	
	function is_geblokkeerd()
    {
        $this->refresh(); // Gegevens over dit ipadres ophalen
		
		// Check of dit ip adres geblokkeerd is volgens de tabel inlogpogingen en return true/false
		
		$iTijdstipBlokkeringOpheffen = $this->aIpadres['tijdstip_geblokkeerd'] + $this->config->item('iAantalSecondenBlokkeren');
		
		if(time() < $iTijdstipBlokkeringOpheffen) return true; // Geblokkeerd als nu eerder is dan het moment waarop de blokkering opgeheven wordt
    }
	
	function berisp()
	{
		$this->refresh(); // Gegevens over dit ipadres ophalen
		
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
	}
	
	function nog_geblokkeerd()
	{
		$this->refresh(); // Gegevens over dit ipadres ophalen
		
		// Uitrekenen hoelang nog geblokkeerd
		
		$iAlGeblokkeerd = time() - $this->aIpadres['tijdstip_geblokkeerd'];
		$iNogGeblokkeerd = $this->config->item('iAantalSecondenBlokkeren') - $iAlGeblokkeerd;
		
		// Return hoelang nog geblokkeerd
		return $iNogGeblokkeerd.' seconde';
	}
}

