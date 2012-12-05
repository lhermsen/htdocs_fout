<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistieken extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('leden/statistieken');
		$this->pagina->footer();
	}
}