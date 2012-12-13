<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voorpagina extends CI_Controller {

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