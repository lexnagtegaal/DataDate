<?php

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	function login($email,$password){
		//password is als md5 hash al meegestuurd.
		$this->load->database(); // laadt het database systeem.
		
		//opbouw van de query'
		$this->db->select('Bijnaam');
		$this->db->from('Gebruiker');
		$this->db->where('Email',strtolower($email));
		$this->db->where('Wachtwoord',$password);
		$query=$this->db->get();// SELECT 'Bijnaam' from Gebruiker where 'Email'=$email and 'Wachtwoord'=$password;
		if ($query->num_rows() > 0){
			$row = $query->row();
			$this->session->set_userdata(array(
												'login'		=>	TRUE,
												'username'	=>	$this->encryption->encrypt($row->Bijnaam)
												)); // Wachtwoord slaan we NIET op.
		}else{
			$this->session->set_userdata('errors','De opgegeven gebruikersnaam en wachtwoord komen niet voor in ons systeem.');
			// De error wordt maar 1 x meegegeven, en dat is precies lang genoeg om deze weer te geven op de inlogpagina.
		}
	}
}


/* We gaan ervanuit dat dit voldoende moet zijn voor de basisfuncties
 * Bij de pagina's die wel van belang zijn!! vragen we extra wachtwoord voor authenticatie.
 * ALS ! ALS er een hi-jacking nu komt, is de persoon niet in staat om op
 * de belangrijke pagina's zijn gang te gaan, want hij heeft immers het wachtwoord niet!
 * Het is geen oplossing voor een hi-jacking probleem, maar meer schadebeperking mocht de situatie zich voordoen.
 *
 * Met de username in de session data communiceren we met de database waar nodig.
 * Minder data beschikbaar om gestolen te worden, alleen de username.
 * De username is al zichtbaar in de profielpagina van de personen dus geen extra informatie.
 * Met behulp van de default encryption key van code igniter wordt de username verhuld
 * zodat je niet stiekem iemand anders username in kan vullen, want deze is standaard niet in het juiste formaat.
 *
 * als bij toegang van de database blijkt dat iemand WEL is ingelogd (login=TRUE) maar niet de juiste username heeft,
 * is er waarschijnlijk iemand bezig met hacken. Als deze situatie voorkomt
 * moet er een tempdata toegevoegd worden met geblokt=true. Deze vervalt na 1200 seconden = 20 minuten.
 *
 * Iemand die probeert tijdens een sessie een andere gebruikersnaam te benutten zal dit maar ייns in de 20 minuten
 * kunnen doen. Hiermee verdwijnt de flexibiliteit en het aantal van de aanvalspogingen.
 *
 * De functie check_Credentials() in credentials handelt dit alles af.
 * Controleert of iemand wel of niet al ingelogd is (Boolean waarde)
 * en als iemand die wel "ingelogd" zou zijn, maar met een niet bestaande gebruikersnaam krijgt automatisch de
 * blok tempdata die na 20 minuten vervalt.
 *
 */
?>