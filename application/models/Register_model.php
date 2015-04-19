<?php
class Register_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function register($data){
		$gebruiker = array(
				'Bijnaam' 			=> $data['Bijnaam'],
				'Email'				=> $data['Email'],
				'Wachtwoord'		=> $data['Wachtwoord']
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
				'Persoonlijkheidstype' => $data['Persoonlijkheidstype'],
				'Foto'				=> $data['Foto']
		);
		for($i=0;$i<count($data['Merken'][0]);$i++){
			$merken= array(
				'Bijnaam'			=> $data['Bijnaam'],
				'Merk'				=> $data['Merken'][0][$i]
				);
			$this->db->insert('Merk',$merken);
		}
		//Alleen Persoonlijkheidstype en Persoonlijkheidsvoorkeur ontbreken nog in dit stadium.
		$this->db->insert('Gebruiker',$gebruiker);
		$this->db->insert('Gebruikersprofiel', $profiel);
		$this->session->tempdata('new_user',$data['Bijnaam']);
	}
	
}

?>
