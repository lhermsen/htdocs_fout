<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiel_reunist extends Profiel {

	public function index()
	{
		// Laad het formulier en geef de gegevens van de gebruiker door aan de view
		
		$this->pagina->header('','reunisten');
		$this->load->view('reunisten/profiel', array('aGebruiker' => $this->gebruiker_model->aDatabase));
		$this->pagina->footer('','reunisten');
	}
	
	public function toon_formulier()
	{
		$this->pagina->header('','reunisten');
		$this->load->view('reunisten/profiel', array('aGebruiker' => $this->gebruiker_model->aDatabase));
		$this->pagina->footer('','reunisten');
	}	
}