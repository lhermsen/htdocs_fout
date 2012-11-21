<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| E-mail
|--------------------------------------------------------------------------
*/

// Het info-emailadres voor de klant
$config['sEmailInfo'] = 'info@nonomes.nl';

// Het emailadres vanwaar e-mails standaard dienen te worden verzonden 
$config['sEmailFrom'] = 'info@nonomes.nl';

// Het emailadres waar ontvangers standaard op dienen te antwoorden
$config['sEmailReplyTo'] = 'info@nonomes.nl';


/*
|--------------------------------------------------------------------------
| IP-adres
|--------------------------------------------------------------------------
*/

// Hoeveel seconden blokkeren wanneer verkeerde inloggegevens
$config['iAantalSecondenBlokkeren'] = 60;

// Hoeveel berispingen voordat het ipadres geblokkeerd wordt
$config['iLimietBerispingen'] = 4;