<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Societeit extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('societeit');
		$this->pagina->footer();
	}
}