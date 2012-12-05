<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistieken extends CI_Controller {

	public function index()
	{
		// Laad de views
		
		$this->pagina->header();
		$this->load->view('reunisten/statistieken');
		$this->pagina->footer();
	}
}