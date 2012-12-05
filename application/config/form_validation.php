<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array
(
	'leden/verwerk' => array
	(
		array
		(
			'field' => 'naam',
			'label' => 'Uw naam',
			'rules' => 'trim|required|xss_clean'
		),
	)
);