<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recht_model extends Crud_model {
		
	public function __construct()
	{
		parent::__construct();
		$sTable = 'rechten';
	}
	
}