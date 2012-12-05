<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiel extends CI_Controller {

	public function index()
	{		
		// Laad het formulier en geef de gegevens van de gebruiker door aan de view
		
		$this->pagina->header();
		$this->load->view('leden/profiel', array('aGebruiker' => $this->gebruiker_model->aDatabase));
		$this->pagina->footer();
	}
	
	public function toon_formulier()
	{
		$this->load->view('leden/profiel', array('aGebruiker' => $this->gebruiker_model->aDatabase));
	}
	
	public function verwerk()
	{
		// Controleer of het formulier juist is ingevuld
		if($this->form_validation->run())
		{
			// Pas de gegevens van de gebruiker aan in de database
			if($this->gebruiker_model->wijzig($_POST))
			{			
				// Gelukt? Laad dan een succesmelding en het formulier en geef de gegevens van de gebruiker door aan de view
				
				$this->pagina->header();
				$this->melding->geef('succes',$sMelding, 'Gebruiker '.$this->gebruiker_model->aDatabase['id'].' heeft profielgegevens aangepast');
				$this->toon_formulier();
				$this->pagina->footer();
			}
			else
			{
				// Als de gegevens niet aangepast kon worden van de gebruiker, geef dan een fatale foutmelding
			
				$sMelding  = 'Uw gegevens konden niet worden aangepast! De beheerder is hiervan op de hoogte gesteld. '; 
				$sMelding .= 'Neem contact op met '.$this->config->item('sEmailInfo').' voor meer informatie.';
			
				$sLogMelding  = 'Gebruiker '.$this->gebruiker_model->aDatabase['id'].' probeerde profielgegevens aan te passen. ';
				$sLogMelding .= 'Gebruikte gegevens: '.implode($_POST);
			
				$this->pagina->header();
				$this->melding->geef('fatale_fout', $sMelding, $sLogMelding);
				$this->pagina->footer();
			}
		}
		else
		{
			// Als het formulier onjuist is ingevuld, toon dan weer het formulier
			$this->index();
		}
	}
}