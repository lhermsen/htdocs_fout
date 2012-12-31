<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logboek extends CI_Controller {

	public function index()
	{
		$aDatabaselogboek = $this->db->get('databaselogboek')->result_array();
		
		$this->pagina->header();
		$this->load->view('gebruikers/beheer/logboek_header', $aDatabaselogboek);
		$this->load->view('gebruikers/beheer/databaselogboek', $aDatabaselogboek);
		$this->pagina->footer();
	}
	
	public function meldingen()
	{
		$aMeldingenlogboek = $this->db->get('meldingenlogboek')->result_array();
		
		$this->pagina->header();
		$this->load->view('gebruikers/beheer/logboek_header', $aDatabaselogboek);
		$this->load->view('gebruikers/beheer/meldingenlogboek', $aDatabaselogboek);
		$this->pagina->footer();
	}
}