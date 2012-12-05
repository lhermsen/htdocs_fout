<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Standaard_reminders extends CI_Controller {

	/*
	|---------------------------------------------------------------------------------------------|
	|	`standaard_reminders`
	|	id, bericht
	|---------------------------------------------------------------------------------------------|
	*/
	
	public function index()
	{
		$this->pagina->header();
		$this->load->view('rooster');
		$this->pagina->footer();
	}
	
	public function nieuwe_reminder()
	{
		
	}
	
	public function wijzig_reminder()
	{
		
	}
	
	public function verwijder_reminder()
	{
		
	}
}