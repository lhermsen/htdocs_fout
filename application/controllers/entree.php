<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entree extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('entree');
		$this->pagina->footer();
	}
}