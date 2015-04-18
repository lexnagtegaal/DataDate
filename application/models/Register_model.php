<?php
class Register_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function register($data){
		$gebruiker = array(
				'Bijnaam' 		=> $data['Bijnaam'],
				'Email'			=> $data['Email'],
				'Wachtwoord'	=> $data['Wachtwoord']
		);
		$profiel = array(
				'Bijnaam' 			=> $data['Bijnaam'],
				'Voornaam'			=> $data['Voornaam'],
				'Tussenvoegsel'		=> $data['Tussenvoegsel'],
				'Achternaam'		=> $data['Achternaam'],
				'E-mailadres'		=> $data['Email'],
				'Geslacht'			=> $data['Geslacht'],
				'Geboortedatum'		=> $data['Geboortedatum'],
				'Beschrijving'		=> $data['Beschrijving'],
				'Geslachtsvoorkeur'	=> $data['Geslachtsvoorkeur'],
				'Minimumleeftijd'	=> $data['Minimumleeftijd'],
				'Maximumleeftijd' 	=> $data['Maximumleeftijd'],
				'Foto'				=> $data['Foto']
		);
		//Alleen Persoonlijkheidstype en Persoonlijkheidsvoorkeur ontbreken nog in dit stadium.
		$this->db->insert('Gebruiker',$gebruiker);
		$this->db->insert('Gebruikersprofiel', $profiel);
		$this->session->tempdata('newuser',$data['Bijnaam']);
	}
	
}

?>
