<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bestand extends CI_Controller {

	public function index()
	{
		// Alle gegevens ophalen die gezien mogen worden
		$aGedeeldeGebruikersData = $this->gebruiker_model->zichtbare_gebruikersdata();
		
		// Laad de views
		
		$this->pagina->header();
		$this->load->view('gebruikers/bestand', array('aGedeeldeGebruikersData' => $aGedeeldeGebruikersData));
		$this->pagina->footer();
	}
}