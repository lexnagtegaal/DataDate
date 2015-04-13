<?php
/* Class om verkeerd gebruik van de session tegen te gaan.
 */
class Credentials extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	function geblokt(){
		// controleert of de tijdelijke variabel geblokt bestaat.
		return null !== $this->session->tempdata('geblokt'); 
		//isset($this->session->tempdata('geblokt'));
	}
	function check_credentials(){ // BOOLEAN functie
		
		// Controleert sessievarabale op correcte loginwaarden!
		
		if($this->session->userdata('login') && !$this->geblokt()){
			// de gebuiker is al ingelogd tijdens deze sessie en we hebben geen reden (Gehad) om de gebruiker te blokkeren.
			return TRUE;
		}
		
		if($this->session->userdata('login')){

			/* code om te controleren of username voorkomt.
			 * Zo niet! Dan wordt de gebruiker tijdelijk uitgesloten van de online community
			 * door de variabele session tempdata te zetten op TRUE en 1200 (=5 minuten)
			 * Daarnaast wordt de session userdata username unset.
			 */
			
			$this->load->database(); // maakt toegang tot database mogelijk.
			$this->load->library('encryption'); // voor het ontcijferen van de gebruikersnaam
			$this->db->$select('Bijnaam');
			$this->db->$from('Gebruiker');
			$this->db->$where('Bijnaam',$this->encryption->decrypt($this->session->userdata('username'))); // Ontcijferen en vergelijken.

			if(!$this->$db->$get()){ // select 'Bijnaam' from Gebruiker where Bijnaam=$bijnaam;
				$this->session->set_tempdata('geblokt','',1200); // Creeert de Block!
				$this->session->unset_userdata('username'); // Laten we maar geen gevoelige informatie rondslingeren als we de gebruiker uit de online community willen houden.
				$this->session->unset_userdata('login'); // Gebruiker is ingelogd.

				//Sessie blijft wel bestaan! We hebben immers de tempdata('geblokt') openstaan.
				
				/* De gebruiker is niet in staat om uit te loggen
				 * (dit omdat de check_credentials false oplevert)
				 * Hij/Zij kan ook niet opnieuw inloggen met een blok.
				 * De hacker is de komende 20 minuten uitgesloten van de community.
				 */ 
			}
		}
		
		return FALSE; // in alle andere gevallen dan de bovenste IF statement return FALSE!
	}
}
?>