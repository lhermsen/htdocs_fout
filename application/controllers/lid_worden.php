<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lid_worden extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('lid_worden');
		$this->pagina->footer();
	}
}