<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$_SESSION['nc_login_user'] = $this->config->item('sCMSGebruikersnaam');
		$_SESSION['nc_login_status'] = true;
		
		redirect(base_url('leden/beheer'));
	}

}