<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Melding {

	/*
	|--------------------------------------------------------------------------------------------
	|	Type meldingen: fatale_fout, fout, waarschuwing, succes
	|	Zodra een melding wordt gegeven, wordt deze opgeslagen in het logboek in de database
	|--------------------------------------------------------------------------------------------
	*/
	
    function geef($sType, $sMelding, $sLogOpmerkingen = '')
    {
        $CI =& get_instance();
		
		// Log de melding in de database
		
		if($sType == 'fatale_fout') $sLogOpmerkingen .= ' - ip:'.$this->input->ip_address();
		$aMelding = array('type'=>$sType,'melding'=>$sMelding,'opmerkingen'=>$sLogOpmerkingen);
		$CI->db->insert('meldingenlogboek',$aMelding);
		
		// Laad view en geef de juiste melding weer
		$CI->load->view('melding/'.$sType, array('melding'=>$sMelding));
    }
}