<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verboden_toegang extends CI_Controller {

	public function index()
	{
		// Geef een foutmelding
	
		$sUri = $this->uri->uri_string;
		
		$sMelding = 'U heeft geen toegang tot deze pagina.';
		
		if(empty($this->gebruiker_model->aDatabase))
		{
			$sLogMelding = 'Publiekelijke bezoeker (ip: '.$this->input->ip_address().') probeerde toegang te verkijgen tot URI: "'.$sUri.'"';
		}
		else
		{
			$sLogMelding = 'Geen toegang tot opgevraagde pagina. URI: "'.$sUri.'" en gebruiker: "'.$this->gebruiker_model->aDatabase['id'].'"';
		}
		
		$this->pagina->header();
		$this->melding->geef('fout',$sMelding, $sLogMelding);
		$this->pagina->footer();
	}
}