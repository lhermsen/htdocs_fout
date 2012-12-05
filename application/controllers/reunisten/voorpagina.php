<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voorpagina extends CI_Controller {

	public function index()
	{
		// Laad de views
		
		$this->pagina->header();
		$this->load->view('reunisten/nieuwsbox');
		$this->load->view('reunisten/navigatie');
		$this->load->view('reunisten/suggesties');
		$this->pagina->footer();
	}
}