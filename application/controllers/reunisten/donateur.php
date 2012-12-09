<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donateur extends CI_Controller {

	public function index()
	{
		// Laad de views
		
		$this->pagina->header();
		$this->load->view('reunisten/nieuwsbox');
		$this->load->view('reunisten/navigatie');
		$this->load->view('reunisten/suggesties');
		$this->pagina->footer();
	}
	
	public function verwerk()
	{
		// Controleer of het formulier juist is ingevuld
		if($this->form_validation->run())
		{
			// Creëer nieuwe donateur in de database en laat email sturen
			$this->donateur_model->nieuw($_POST);
		} 
		else
		{
			// Als het formulier onjuist is ingevuld, toon dan weer het formulier
			$this->index();
		}
	}
}