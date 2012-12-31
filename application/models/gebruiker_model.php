<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gebruiker_model extends CI_Model {

	var $aDatabase = array();
	
	var $aSubgroepIds = array();
	var $aSubgroepNamen = array();

	function nieuw($aGegevens, $bVerzend_Email = false)
	{
		// Zet de datum in het juiste format als dat nog niet gedaan is
		
		if(!is_standaard_datumnotatie($aGegevens['geboortedatum']))
		{
			$aGegevens['geboortedatum'] = $aGegevens['jaar'].'-'.$aGegevens['maand'].'-'.$aGegevens['dag'];
		}
		
		// Codeer het wachtwoord
		$aGegevens['wachtwoord'] = md5($aGegevens['wachtwoord']);
		
		// Hoofdletters voor de voor en achternaam
		
		$aGegevens['voornaam'] = ucfirst($aGegevens['voornaam']);
		$aGegevens['achternaam'] = ucfirst($aGegevens['achternaam']);
		
		// Voeg de nieuwe gebruiker toe aan database
		
		$this->db->insert('gebruikers',$aGegevens);
		$iId = $this->db->insert_id();
		
		// Zet deze toevoeging in het databaselogboek
		$this->databaselogboek_model->nieuwe_rij('gebruikers', $iId, $aGegevens, $_SESSION['gebruiker']);
		
		// Codeer het idnummer voor de activatielink
		
		$sIdEncrypted = $this->encrypt->encode($iId);
		$sIdGecodeerd = base64_encode($sIdEncrypted);
		
		// Stuur e-mail naar de gebruiker om het wachtwoord in te laten stellen
		
		if($bVerzend_Email)
		{
			$sBericht = $this->load->view('emails/wachtwoord_instellen',$aGegevens, true);

			$this->email->to($aGegevens['emailadres']);
			$this->email->subject($aGegevens['voornaam'].' '.$aGegevens['achternaam'].', stel uw wachtwoord in');
			$this->email->verzend_bericht($sBericht);
			
			$this->db->where('id', $iId);
			$this->db->update('gebruikers', array('activatiemail_ontvangen'=>1));
		}
	}
	
	function set($iId, $bIdIsGecodeerd = false)
	{
		if($bIdIsGecodeerd) $iId = $this->decodeer_id($iId);
		
		// Haal alle data van deze gebruikers_id uit de database en zet de vars
		$this->aDatabase = $this->db->get_where('gebruikers',array('id'=>$iId))->row_array();
		
		// Inventariseer tot welke subgroepen deze gebruiker behoort
		
		$this->db->where('gebruiker_id', $iId);
		$aGekoppeldeSubgroepen = $this->db->get('gebruiker_subgroep')->result_array();
		
		// Doorloop alle subgroepen die gekoppeld zijn aan deze gebruiker
		foreach($aGekoppeldeSubgroepen as $aGekoppeldeSubgroep)
		{
			// Haal de record van deze gekoppelde subgroep op uit de database
			$aSubgroep = $this->db->get_where('subgroepen', array('id'=>$aGekoppeldeSubgroep['subgroep_id']));
			
			// Zet in een array de id van deze subgroep waartoe deze gebruiker behoort
			$this->aSubgroepIds[] = $aSubgroep['id'];
			
			// Zet in een array de naam van deze subgroep waartoe deze gebruiker behoort
			$this->aSubgroepnamen[] = $aSubgroep['naam'];
		}
	}
		
	function refresh()
	{
		// Update de waarden van deze gebruiker in dit object
		$this->set($this->aDatabase['id']);
	}
	
	function publiekelijk()
	{			
		// Zet in een array de id van deze subgroep waartoe deze gebruiker behoort (publiekelijk)
		$this->aSubgroepIds = array(0);
	}
	
	function authenticeer($sEmail = '', $sMd5Wachtwoord = '')
	{
		/*
		|-----------------------------------------------------------------------------------------
		|	Check of de gebruiker bestaat in de database met ingevuld emailadres en wachtwoord. 
		|	Als hij bestaat, log hem dan in en zet alle gegevens van dit object naar deze gebruiker.
		|-----------------------------------------------------------------------------------------
		*/
	
		// Check of de gebruiker bestaat in de database met ingevuld emailadres en wachtwoord
		
		$this->db->where(array('emailadres'=>$sEmail, 'wachtwoord'=>$sMd5Wachtwoord));
		$qGebruikers = $this->db->get('gebruikers');
		$iGevondenGebruikers = $qGebruikers->num_rows();
		
		// Als het lid kon worden geauthenticeerd
		if($iGevondenGebruikers > 0)
		{		
			// Haal alle gegevens op van de gebruiker
			$aGebruiker = $qGebruikers->row_array();
			
			// Zet de waarden van dit object
			$this->set($aGebruiker['id']);
			
			// Login
			$this->login();
			
			return true;
		}
		
		return false;
	}
	
	function authenticeer_sociaal($sProvider = '', $aGegevens = array())
	{
		// Kijk of met de gegevens van het sociale medium (provider) een gebruiker gevonden kan worden die daarmee te identificeren is. In array staan de gegevens waarmee geauthenticeerd kan worden. 
		
		
		
		// Gelukt? Dan login en set met het gevonden id. Return true/false
	}
	
	function login()
	{
		// Zet de sessie naar het id-nummer van de in te loggen gebruiker
		$_SESSION['gebruiker'] = $this->aDatabase['id'];
		
		// Als het veld met het tijdstip waarop voor het laatst is ingelogd nog leeg is, dan is deze gebruiker nog nooit eerder ingelogd geweest
		if($this->aDatabase['last_login'] == '') 
		{
			// Zet de sessie 'eerstelogin' op true
			$_SESSION['eerstelogin'] = true;
		}
		
		// Update de database met de huidige tijd voor last_login
		
		$this->db->where('id', $this->aDatabase['id']);
		$this->db->update('gebruikers', array('last_login'=>time()));
		
		$this->refresh(); // Update de waarden van dit object
	}
	
	function is_ingelogd()
	{
		// Controleer of deze gebruiker is ingelogd
		
		if(isset($_SESSION['gebruiker']))
		{
			// Haal de gegevens van de ingelogde gebruiker op
			$this->set($_SESSION['gebruiker']);
			
			// Als er iets is foutgegaan in het identificeren van de gebruiker met de sessie
			if(empty($this->aDatabase['id'])) return false;
			
			return true;
		}
		
		return false;
	}
	
	function decodeer_id($sIdGecodeerd)
	{
		// Decodeer het id-nummer

		$sIdEncrypted = base64_decode($sIdGecodeerd);
		$iId = $this->encrypt->decode($sIdEncrypted);
		
		return $iId;
	}
	
	function wachtwoord_instellen($sIdGecodeerd, $sWachtwoord)
	{
		// Zet de waarden van dit object naar ingevoerd gecodeerd id-nummer
		$this->set($iId, true);
		
		// Kijk of een gebruiker is gevonden
		if(empty($this->aDatabase['id'])) return false;
		
		// Check of wachtwoordveld leeg is. Zo niet, return false
		if(!empty($this->aDatabase['wachtwoord'])) return false;
		
		// Zet het wachtwoord in de database
		$this->wijzig(array('wachtwoord'=>$sWachtwoord));

		// Stuur een email naar de gebruiker met behulp van de email library
		
		$sBericht = $this->load->view('emails/wachtwoord_ingesteld',$aDatabase, true);
		
		$this->email->to($aDatabase['emailadres']);
		$this->email->subject('Wachtwoord Ingesteld');
		$this->email->verzend_bericht($sBericht);
		
		return true;
	}
	
	function reset_wachtwoord($sEmailadres)
	{
		// Selecteer gebruiker bij dit emailadres
		
		$this->db->where('emailadres', $sEmailadres);
		$aGebruiker = $this->db->get('gebruikers')->row_array();
		
		// Zet de waarden van dit object naar gevonden id-nummer
		$this->set($aGebruiker['id']);
		
		// Kijk of een gebruiker is gevonden. Zo niet, return false.
		if(empty($this->aDatabase['id'])) return false;
		
		// Genereer random wachtwoord
		
		$this->load->helper('string');
		$sRandomWachtwoord = random_string('alpha',8);
		$sMd5RandomWachtwoord = md5($sRandomWachtwoord);
		
		// Zet het nieuwe wachtwoord in de database
		$this->wijzig(array('wachtwoord' => $sMd5RandomWachtwoord));
		
		// Stuur email
		
		$sBericht = $this->load->view('emails/wachtwoord_vergeten',$aGebruiker, true);
		
		$sTitel = ($aGebruiker['geslacht'] == 'm') ? 'Meneer' : 'Mevrouw';
		$sOnderwerp = $sTitel.' '.$aGebruiker['achternaam'].', uw nieuwe wachtwoord';
		
		$this->email->to($aDatabase['emailadres']);
		$this->email->subject($sOnderwerp);
		$this->email->verzend_bericht($sBericht);
		
		return true; // True als alles gelukt is
	}
	
	function wijzig($aGegevens)
	{
		$this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->update('gebruikers', $aGegevens)) return false;
		
		// Zet de wijziging in het logboek
		$this->databaselogboek_model->wijzigingen('gebruikers', $this->aDatabase['id'], $this->aDatabase, $aGegevens, $_SESSION['gebruiker']);

		// Update de waarden van dit object
		$this->refresh(); 
		
		return true;
	}

	function is_reunist()
	{
		// Return true als deze gebruiker behoort tot de subgroep 'reunisten'
		if(in_array('Reunisten',$this->aSubgroepnamen)) return true;
		
		// Zo niet, return false
		return false;
	}
	
	function zichtbare_gebruikers()
	{
	
	}
	
	function zichtbare_gebruikersdata()
	{
		/*
		|----------------------------------------------------------------------------
		| 	Vogel hier uit welke data van andere gebruikers deze gebruiker mag zien
		|-----------------------------------------------------------------------------
		*/
		
		$sQuery = "";
		
		foreach($this->aSubgroepIds as $iSubgroepId) // Doorloop alle idnummers van de subgroepen waartoe deze gebruiker behoort
		{
			// Kijk vervolgens per gebruiker wat die wil delen aan de subgroepen waar deze gebruiker toe behoort. 
			
			$this->db->where('subgroep_id', $iSubgroepId);
			$aGedeeldeGegevensRijen = $this->db->get('gebruiker_gebruikerswaarde_subgroep')->result_array();
			
			foreach($aGedeeldeGegevensRijen as $iKeyGedeeldeGegevens => $aGedeeldeGegevens)
			{
				if($sQuery != "") $sQuery .= " UNION "; // Voeg de querydelen samen tot één selecterende query
				
				// Voeg iedere gedeelde kolom van iedere delende gebruiker toe aan de query. Selecteer hierbij alleen gebruikers met dezelfde lidmaatschap_id als deze gebruiker
				
				$sQuery .= "(SELECT '".$aGedeeldeGegevens['gebruikerswaarde_kolom']."' WHERE `id`='".$aGedeeldeGegevens['gebruiker_id']."' AND `lidmaatschap_id`='".$this->aDatabase['lidmaatschap_id']."')";
			}
		}
		
		$aGedeeldeGebruikersData = $this->db->get('gebruikers')->result_array();
		
		return $aGedeeldeGebruikersData;
	}
	
	function heeft_recht($sUri)
	{
		// Kijk of de ingelogde gebruiker het recht heeft om deze pagina te zien
		
		if(empty($sUri)) return true;
		
		foreach($this->aSubgroepIds as $iSubgroepId) // Doorloop alle idnummers van de subgroepen waartoe deze gebruiker behoort
		{
			// Haal de rechten op van deze subgroep
			
			$this->db->where('subgroep_id', $iSubgroepId);
			$aRechten = $this->db->get('rechten')->result_array();
			
			// Doorloop alle rechten van deze subgroep waartoe de gebruiker behoort. Kijk of de subgroep het recht heeft om deze uri te zien.
			foreach($aRechten as $aRecht)
			{
				// Als de gebruiker deze uri mag zien, return true
				if($aRecht['uri'] == $sUri) return true;
	
				// Als er een sterretje staat in het 'recht' in de database,  dan moet de gebruiker recht krijgen tot een volledige map (bijvoorbeeld: leden/*)
				if(strpos($aRecht['uri'], '*') !== false)
				{
					$aRechtMap = explode("/*",$aRecht['uri']);
					$sRechtMap = $aRechtMap[0];
				
					// Kijk of de huidige uri in de map ligt waar de gebruiker toegang toe heeft. Zo ja, verleen dan de toegang.
					if(substr($sUri, 0, strlen($sRechtmap)) == $sRechtMap) return true;
				}
			}
			
			// Geen positief resultaat? Dan return false.
			return false;
		}
	}
}