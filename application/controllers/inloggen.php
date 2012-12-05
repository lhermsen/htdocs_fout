<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inloggen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('ipadres_model');
		$this->load->model('gebruiker_model');
		
		if($this->ipadres_model->is_geblokkeerd()) $this->geblokkeerd();
		if($this->gebruiker_model->is_ingelogd()) $this->_doorsturen();
	}

	public function index()
	{
		// Laad de pagina
		
		$this->pagina->header();
		$this->load->view('inloggen');
		$this->pagina->footer();
	}
	
	public function geblokkeerd()
	{
		// Stel foutmelding op
		
		$iSecondenNogGeblokkeerd = $this->ipadres_model->nog_geblokkeerd();
		
		$sMelding  = "Uw kunt tijdelijk niet inloggen omdat u te vaak verkeerde inloggegevens ingevuld heeft. "; 
		$sMelding .= "Over ".$iSecondenNogGeblokkeerd." seconde kunt u weer inloggen.";
		
		// Laad de pagina
		
		$this->pagina->header();
		$this->melding->geef('fout',$sMelding, 'Geblokkeerd wegens teveel inlogpogingen');
		$this->pagina->footer();
	}
	
	public function poging()
	{
		// Probeer gebruiker te authoriseren op basis van ingevuld emailadres en wachtwoord
		
		if($this->gebruiker_model->authenticeer($this->input->post('email'), $this->input->post('wachtwoord')))
		{
			// Geauthenticeerd? Doorsturen naar ledengedeelte
			$this->_doorsturen();
		}
		else
		{
			// Niet geauthoriseerd? Geef het ipadres een berisping. 
			$iTotaalBerispingen = $this->ipadres_model->berisp();
			
			// Checken of nu geblokkeerd. 
			if($this->ipadres_model->is_geblokkeerd()) 
			{
				// Zo ja, handel verder af met this->geblokkeerd
				$this->geblokkeerd();
			}
			else
			{			
				// Zo niet, reken uit hoeveel pogingen over
				$iPogingenOver = $this->config->item('iLimietBerispingen') - $iTotaalBerispingen;
				
				// Stel waarschuwingsmelding op
				$sMelding = "U heeft nog ".$iPogingenOver." inlogpogingen over.";
				
				// Geef waarschuwingsmelding
				
				$this->pagina->header();
				$this->melding->geef('fout',$sMelding, 'Ipadres '.$this->input->ip_address().' geblokkeerd wegens teveel inlogpogingen');
				$this->pagina->footer();
			}
		}
	}
	
	public function wachtwoord_instellen($sIdGecodeerd)
	{
		// Haal de gebruikersgegevens erbij
		
		$this->gebruiker_model->set($sIdGecodeerd, true);
		$aGebruiker = $this->gebruiker_model->aDatabase;
		
		// Toon wachtwoord-instel-formulier
		
		$this->pagina->header();
		$this->load->view('wachtwoord_instellen', array('aGebruiker'=>$aGebruiker));
		$this->pagina->footer();
	}
	
	public function wachtwoord_instellen_poging($sIdGecodeerd)
	{
		// Update het wachtwoord van de gebruiker
		
		if($this->gebruiker_model->wachtwoord_instellen($sIdGecodeerd, $this->input->post('wachtwoord')))
		{
			// Login gebruiker
			$this->gebruiker_model->login();
			
			// Stuur door naar ledengedeelte
			$this->_doorsturen();
		}
		else
		{
			// Stel fatale foutmelding op
			$sMelding = "Oeps, er ging iets mis! De beheerder is op de hoogte gesteld. Stuur voor vragen een e-mail naar ".$this->config->item('sEmailInfo').".";
			
			// Stel de melding op die in het logboek moet komen te staan
			
			$sLogMelding  = 'Wachtwoord instellen, gebruikers-id:'.$this->gebruiker_model->aDatabase['id'].' ';
			$sLogMelding .= 'Gepost wachtwoord: '.$this->input->post('wachtwoord');
			
			// Geef fatale foutmelding
			
			$this->pagina->header();
			$this->melding->geef('fatale_fout',$sMelding, $sLogMelding);
			$this->pagina->footer();
		}
	}
	
	public function wachtwoord_vergeten()
	{
		// Haal het eventuele emailadres uit de postdata
		$sEmail = $this->input->post('email');
		
		// Laad header van de pagina
		$this->pagina->header();
		
		// Als het formulier verstuurd is
		if(!empty($sEmail))
		{
			// Probeer het wachtwoord te resetten met het gekregen emailadres
			if($this->gebruiker_model->reset_wachtwoord($sEmail))
			{
				// Als het wachtwoord resetten is gelukt
				
				$sMelding = 'Uw wachtwoord is opnieuw ingesteld en per email naar u verzonden';
				$this->melding->geef('succes',$sMelding, 'Wachtwoord succesvol gereset door '.$sEmail);
			}
			else
			{
				// Als het wachtwoord resetten is mislukt
				
				$sMelding = 'Uw wachtwoord kon niet opnieuw ingesteld worden. Controleer of u het juiste emailadres heeft ingevuld.';
				$this->melding->geef('fout',$sMelding, 'Wachtwoord kon niet gereset worden voor '.$sEmail);
			}
		}
		
		// Toon formulier om het emailadres in te vullen
		$this->load->view('wachtwoord_vergeten');
		
		// Laad footer van de pagina
		$this->pagina->footer();
	}
	
	public function _doorsturen()
	{
		// Bereid redirect voor op de keuze om de gebruiker naar het reunisten- of ledengedeelte te sturen
		$sGedeelte = ($this->gebruiker_model->is_reunist()) ? 'reunisten' : 'leden';
		
		// Stuur door naar de wijzig-pagina wanneer de gebruiker voor de eerste keer inlogt
		
		if(isset($_SESSION['eerstelogin']))
		{
			redirect(base_url($sGedeelte.'/wijzig'));
		}
		
		// Stuur eventueel door naar eerdere redirect URL
		
		if($_SESSION['redirect'] != '')
		{
			redirect($_SESSION['redirect']);
		}
		
		// Stuur door naar het gebruikersgedeelte
		redirect(base_url($sGedeelte));
	}
}