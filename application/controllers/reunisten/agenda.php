<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function index()
	{
		// Laad de views
		
		$this->pagina->header('','reunisten');
		$this->load->view('reunisten/agenda');
		$this->pagina->footer('','reunisten');
	}
}