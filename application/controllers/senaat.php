<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Senaat extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('senaat');
		$this->pagina->footer();
	}
}