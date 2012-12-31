<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subgroepcategorie_model extends Crud_model {
		
	public function __construct()
	{
		parent::__construct();
		$sTable = 'subgroepcategorieen';
	}
	
}