<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index()
	{
		$this->pagina->header();
		$this->load->view('contact');
		$this->pagina->footer();
	}
}