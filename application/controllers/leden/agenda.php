<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('leden/agenda');
		$this->pagina->footer();
	}
}