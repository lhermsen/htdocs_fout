<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voorpagina extends CI_Controller {

	public function index()
	{
		$this->pagina->header(array('slideshow'));
		$this->load->view('voorpagina');
		$this->pagina->footer();
	}
}