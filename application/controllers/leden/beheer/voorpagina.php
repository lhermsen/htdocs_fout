<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voorpagina extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('leden/nieuwsbox');
		$this->load->view('leden/navigatie');
		$this->load->view('leden/beheer/navigatie');
		$this->load->view('gebruikers/beheer/logout');
		$this->pagina->footer();
	}
}