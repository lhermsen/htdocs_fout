<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donateur_model extends CI_Model {

	function nieuw($aGegevens)
	{
		// Hoofdletters voor de voor en achternaam
		
		$aGegevens['voornaam'] = ucfirst($aGegevens['voornaam']);
		$aGegevens['achternaam'] = ucfirst($aGegevens['achternaam']);
		
		// Voeg de nieuwe donateur toe aan database
		$this->db->insert('donateurs',$aGegevens);
		
		// Stuur e-mail naar de nieuwe donateur
	
		$sBericht = $this->load->view('emails/reunisten/nieuwe_donateur',$aGegevens, true);

		$this->email->to($aGegevens['emailadres']);
		$this->email->subject($aGegevens['voornaam'].' '.$aGegevens['achternaam'].', dank voor uw donateurschap');
		$this->email->verzend_bericht($sBericht);
	}
}