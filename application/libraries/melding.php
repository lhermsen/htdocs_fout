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
        // Log de melding in de database
		
		$aMelding = array('type'=>$sType,'melding'=>$sMelding,'opmerkingen'=>$sLogOpmerkingen);
		$this->db->insert('logboek_meldingen',$aMelding);
		
		// Laad view en geef de juiste melding weer
		$this->load->view('melding/'.$sType, array('melding'=>$sMelding));
    }
}