<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {

	public function verzend_bericht($sBericht)
	{
		// Verzender
		$this->from($this->config->item('sEmailFrom'));
		
		// Antwoordadres
		$this->reply_to($this->config->item('sEmailReplyTo'));
		
		// Header en footer inladen
		$sHeader = $this->load->view('emails/header','',true);
		$sFooter = $this->load->view('emails/footer','',true);
		
		// Header, bericht, footer: aan elkaar plakken
		$this->message($sHeader.$sBericht.$sFooter);
		
		// Verzend email 
		$this->send();
	}
	
}