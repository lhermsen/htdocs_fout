<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donateur extends CI_Controller {

	public function index()
	{
		// Laad de views
		
		$this->pagina->header('','reunisten');
		$this->load->view('reunisten/doneren');
		$this->pagina->footer('','reunisten');
	}
	
	public function verwerk()
	{
		// Controleer of het formulier juist is ingevuld
		if($this->form_validation->run())
		{
			// Creëer nieuwe donateur in de database en laat email sturen
			$this->donateur_model->nieuw($_POST);
			
			// Geef melding dat het is gelukt om de donateur in te voeren
			
			$sMelding = "Gelukt! Wij hebben uw gegevens in goede orde ontvangen. Dank u wel voor uw donateurschap.";
			$this->melding->geef('succes',$sMelding, 'Donateur toegevoegd');
		} 
		else
		{
			// Als het formulier onjuist is ingevuld, toon dan weer het formulier
			$this->index();
		}
	}
}