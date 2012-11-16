<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gebruiker_model extends CI_Model {

	var $aDatabase;

	function refresh()
	{
		// Update de waarden van deze gebruiker in dit object
		$this->set($this->aDatabase['id']);
	}
	
	function set($iId)
	{
		// Haal alle data van deze gebruikers_id uit de database en zet de vars
		$this->aDatabase = $this->db->get_where('gebruikers',array('id'=>$iId))->row_array();
	}
	
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
			
			$this->db->where('id' => $iId);
			$this->db->update('gebruikers', array('activatiemail_ontvangen'=>1));
		}
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
		
		if($_SESSION['gebruiker'] == $this->aDatabase['id']) return true;
		return false;
	}
	
	function wachtwoord_instellen($sIdGecodeerd, $sWachtwoord)
	{
		try
		{
			// Decodeer het id-nummer
	
			$sIdEncrypted = base64_decode($sIdGecodeerd);
			$iId = $this->encrypt->decode($sIdEncrypted);
			
			// Zet het wachtwoord in de database
			
			$sMd5Wachtwoord = md5($sWachtwoord);
			
			$this->db->where('id', $iId);
			$this->db->update('gebruikers', array('wachtwoord' => $sMd5Wachtwoord));
			
			$this->refresh(); // Update de waarden van dit object
			
			// Stuur een email naar de gebruiker met behulp van de email library
			
			$sBericht = $this->load->view('emails/account_geactiveerd',$aDatabase, true);
			
			$this->email->to($aDatabase['emailadres']);
			$this->email->subject('Account Geactiveerd');
			$this->email->verzend_bericht($sBericht);
		}
		catch(Exception $e)
		{
			return false;
		}
		
		return true;
	}
	
	function reset_wachtwoord($sEmailadres)
	{
		// Selecteer gebruiker bij dit emailadres.
		
		$this->db->where(array('emailadres', $sEmailadres);
		$aGebruiker = $this->db->get('gebruikers')->row_array();
		
		// Genereer random wachtwoord
		
		$this->load->helper('string');
		$sRandomWachtwoord = random_string('alpha',8);
		$sMd5RandomWachtwoord = md5($sRandomWachtwoord);
		
		// Zet het nieuwe wachtwoord in de database
		
		$this->db->update('gebruikers', array('wachtwoord'=>$sMd5RandomWachtwoord));
		
		$this->refresh(); // Update de waarden van dit object
		
		// Stuur email
		
		$sBericht = $this->load->view('emails/wachtwoord_vergeten',$aGebruiker, true);
		
		$sTitel = ($aGebruiker['geslacht'] == 'm') ? 'Meneer' : 'Mevrouw';
		$sOnderwerp = $sTitel.' '.$aGebruiker['achternaam'].', uw nieuwe wachtwoord';
		
		$this->email->to($aDatabase['emailadres']);
		$this->email->subject($sOnderwerp);
		$this->email->verzend_bericht($sBericht);
	}
	
	function wijzig($aGegevens)
	{
		$this->db->where('id', $this->aDatabase['id']);
		if(!$this->db->update('gebruikers', $aGegevens)) return false;
		
		$this->refresh(); // Update de waarden van dit object
		
		return true;
	}

	function zichtbare_gebruikers()
	{
	
	}
	
	function zichtbare_gebruikersdata($iGebruiker)
	{
		/*
		|----------------------------------------------------------------------------
		| 	Vogel hier uit welke data van andere gebruikers deze gebruiker mag zien
		|-----------------------------------------------------------------------------
		*/
		
		// Inventariseer eerst tot welke subgroepen deze ingelogde gebruiker behoort
		
		$this->db->select('subgroep_id');
		$this->db->where('gebruiker_id', $this->aDatabase['id']);
		$aSubgroepIds = $this->db->get('gebruiker_subgroep')->result_array();
		
		$sQuery = "";
		
		foreach($aSubgroepIds as $iKeySubroep => $iSubgroepId) // Doorloop alle idnummers van de subgroepen waartoe deze gebruiker behoort
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
	
	
}

