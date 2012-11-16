<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina {

	/*
	|--------------------------------------------------------------------------------------------
	|	Laadt de header in zijn volledigheid
	|	Laadt de footer
	|--------------------------------------------------------------------------------------------
	*/
	
    function header($aInladen = array(), $sSubmap = '')
    {
		if($sSubmap != '') $sSubmap .= '/';
		
		$CI =& get_instance();
		$CI->load->view($sSubmap.'header_open');
		
		if(!empty($aInladen))
		{
			foreach($aInladen as $sView)
			{
				$CI->load->view('inladen/'.$sView);
			}
		}
		
		$CI->load->view($sSubmap.'header_sluit');
    }
	
	function footer($sSubmap = '')
	{
		$CI =& get_instance();
		$CI->load->view($sSubmap.'footer');
	}
}