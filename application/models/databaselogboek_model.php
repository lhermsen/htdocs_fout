<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Databaselogboek_model extends CI_Model {

	/* Houdt bij wat in de database wordt gewijzigd en door welke gebruiker */

	function wijziging($sTabel, $sKolom, $iIdRij, $sWaardeOud, $sWaardeNieuw, $iGebruikerId)
	{
		$aLog = array(
			'tabel' => $sTabel,
			'kolom' => $sKolom,
			'rij_id' => $iIdRij,
			'waarde_oud' => $sWaardeOud,
			'waarde_nieuw' => $sWaardeNieuw,
			'gebruiker_id' => $iGebruikerId
		);
		
		$this->db->insert('databaselogboek', $aLog);
	}
	
	function nieuwe_rij($sTabel, $iIdRij, $aGegevens, $iGebruikerId)
	{
		foreach($aGegevens as $sKolom => $sWaardeNieuw)
		{
			$this->wijziging($sTabel, $sKolom, $iIdRij, '', $sWaardeNieuw, $iGebruikerId);
		}
	}
	
	function wijzigingen($sTabel, $iIdRij, $aGegevensOud, $aGegevensNieuw, $iGebruikerId)
	{
		foreach($aGegevensNieuw as $sKolom => $sWaardeNieuw)
		{
			$sWaardeOud = $aGegevensOud[$sKolom];
			$this->wijziging($sTabel, $sKolom, $iIdRij, $sWaardeOud, $sWaardeNieuw, $iGebruikerId);
		}
	}
}