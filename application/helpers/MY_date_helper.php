<?php

	function nederlandse_datumnotatie($sDatum)
	{
		$aDatum = explode("-",$sDatum);
		return $aDatum['2'].'-'.$aDatum['1'].'-'.$aDatum['0'];
	}
	
	function is_standaard_datumnotatie($sDatum)
	{
		// Check of de datum in de gestandaardiseerde datumnotatie staat
		
		if(empty($sDatum)) return false;
		
		$aDatum = explode("-",$sDatum);
		
		if(strlen($aDatum[0]) != 4) return false;
		if(strlen($aDatum[1]) != 2) return false;
		if(strlen($aDatum[2]) != 2) return false;
		
		return true;
	}