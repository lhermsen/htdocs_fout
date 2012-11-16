<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verbanden extends CI_Controller {

	public function index()
	{
		// Laad het model dat de subgroepen behandelt
		$this->load->model('subgroepen_model');
		
		// Haal de subgroepen op, geordend op categorie
		$aSubgroepenOpCategorie = $this->subgroepen_model->get();
		
		// Laad de pagina
		
		$this->pagina->header();
		$this->load->view('verbanden',array('aSubgroepenOpCategorie'=>$aSubgroepenOpCategorie));
		$this->pagina->footer();
	}
}