<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooster extends CI_Controller {

	/*
	|---------------------------------------------------------------------------------------------|
	|	`taken`
	|	id, begin, eind, taak, locatie, reminder
	|
	|	`gebruiker_taak`
	|	gebruiker_id, taak_id
	|---------------------------------------------------------------------------------------------|
	*/
	
	public function index()
	{
		$this->pagina->header();
		$this->load->view('rooster');
		$this->pagina->footer();
	}
	
	public function nieuwe_taak()
	{
		
	}
	
	public function wijzig_taak()
	{
		
	}
	
	public function verwijder_taak()
	{
		
	}
}