<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gebruikers_model extends CI_Model {

    function exporteer($aIdsGebruikers)
    {
        // Kijk naar welke gebruiker is ingelogd. Is dat een reunistbeheerder of een ledenbeheerder? Een reunistbeheerder mag max 50 actieve leden exporteren. En andersom.
		
		// Exporteerde gegevens van alle gebruikers waarvan het id in de gegeven array staat naar een excel bestand.
		
    }	
}

