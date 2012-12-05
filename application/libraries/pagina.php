<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina {

	/*
	|--------------------------------------------------------------------------------------------
	|	Kijkt of een eventuele ingelogde gebruiker deze pagina mag zien
	|	Laadt de header in zijn volledigheid
	|	Laadt de footer
	|--------------------------------------------------------------------------------------------
	*/
	
	var $CI;
	
    function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->model('gebruiker_model');
		
		// Kijk of een gebruiker is ingelogd
		if(!$this->CI->gebruiker_model->is_ingelogd())
		{
			// Log deze bezoeker in als publiekelijk gebruiker
			$this->CI->gebruiker_model->publiekelijk();
		}
	
		// Haal de uri op van deze pagina
		$sUri = $this->CI->uri->uri_string;
		
		// Kijk of het deze gebruiker verboden is om deze pagina te zien
		if(!$this->CI->gebruiker_model->heeft_recht($sUri))
		{
			redirect('/verboden_toegang');
		}
	}
	
	function header($aInladen = array(), $sSubmap = '')
    {
		if($sSubmap != '') $sSubmap .= '/';
		
		$this->CI->load->view($sSubmap.'header_open');
		
		if(!empty($aInladen))
		{
			foreach($aInladen as $sView)
			{
				$this->CI->load->view('inladen/'.$sView);
			}
		}
		
		$this->CI->load->view($sSubmap.'header_sluit');
    }
	
	function footer($sSubmap = '')
	{
		$this->CI->load->view($sSubmap.'footer');
	}
}