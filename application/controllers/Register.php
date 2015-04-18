<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('credentials');
		$this->load->model('register_model','register');
		$this->load->helper('form');
		$this->load->library('form_validation'); // voor de input validatie van het login formulier
		$this->load->helper('regex');
		$this->load->helper('merken');
	}
	public function index(){

		if($this->credentials->check_credentials() || $this->session->has_tempdata['Geblokt']){// Als ik ben ingelogd of geblokt ben, deze pagina NIET weergeven.
			header('Location: '.base_url("home"));
			exit;
		}else{
			//validatieregels voor het registreerformulier
			$this->form_validation->set_rules('Nickname', 'Bijnaam', 'trim|required|min_length[4]|alpha_dash|callback_username_check');
			$this->form_validation->set_rules('email', 'E-mailadres', 'trim|required|callback_email_check');
			$this->form_validation->set_rules('FirstName','Voornaam', 'trim|required');
			$this->form_validation->set_rules('LastName','Achternaam', 'trim|required');
			$this->form_validation->set_rules('password','Wachtwoord','trim|required|alpha_numeric');
			$this->form_validation->set_rules('password_confirm','Wachtwoord','trim|matches[password]');
			$this->form_validation->set_rules('Geboortedatum','Geboortedatum','required');
			$this->form_validation->set_rules('Gender','Geslacht','required');
			$this->form_validation->set_rules('Geboortedatum', 'Geboortedatum','callback_leeftijd_check');
			$this->form_validation->set_rules('Beschrijving','Beschrijving','required');
			$this->form_validation->set_rules('Voorkeur[]','Interresse','required');
			$this->form_validation->set_rules('min','Mimimumleeftijd','required|callback_minimaxi_check['.set_value('max').']');
			$this->form_validation->set_rules('max','Maximumleeftijd','required');
			
			
	
			if($this->form_validation->run()==FALSE){ // als er geen correcte validatie heeft plaatsgevonden.
				$this->view('register',NULL);
			}else{
				// Het formulier voldoet aan alle eisen, dus de account kan aangemaakt worden!
				if(set_value('Gender')=="Man"){
					$foto=="image/Man.png"; // default plaatje man
				}else{
					$foto=="image/Vrouw.png"; // default plaatje vrouw
				}
				$data = array(
						'Bijnaam' 			=> strtolower(set_value('Nickname')),
						'Email'				=> strtolower(set_value('email')),
						'Wachtwoord'		=> md5(set_value('password')),
						'Voornaam'			=> strtolower(set_value('FirstName')),
						'Tussenvoegsel'		=> strtolower(set_value('MiddleName')),
						'Achternaam'		=> strtolower(set_value('LastName')),
						'E-mailadres'		=> strtolower(set_value('email')),
						'Geslacht'			=> set_value('Gender'),
						'Geboortedatum'		=> set_value('Geboortedatum'),
						'Beschrijving'		=> set_value('Beschrijving'),
						'Geslachtsvoorkeur'	=> set_value('Voorkeur[0]').set_value('Voorkeur[1])'), // resulteert in ManVrouw.
						'Minimumleeftijd'	=> (set_value('min')+18),
						'Maximumleeftijd' 	=> (set_value('max')+18),
						'foto'				=> $foto
				);
				$this->register->register($data);
			}
		}
	}
	
	//Onderstaande functie dienen public te zijn voor benadering vanuit form_validation.php
	//Ze zijn getest op XSS, mede dankzij codeigniter, is dit niet te behalen bij onderstaande functies.
	
	public function username_check($user)
	{
		// controleert of gebruikersnaam voorkomt in de tabel.
		
		//opbouw van de query
		$this->db->select('Bijnaam');
		$this->db->from('Gebruiker');
		$this->db->where('Bijnaam',strtolower($user));
		$query=$this->db->get();// SELECT 'Bijnaam' from Gebruiker where 'Bijnaam'=$user;
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('username_check', '{field} bestaat al in de database. Gebruik een andere bijnaam.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	public function email_check($email)
	{
		// controleert of gebruikersnaam voorkomt in de tabel.
		//opbouw van de query'
		$this->db->select('Email');
		$this->db->from('Gebruiker');
		$this->db->where('Email',strtolower($email));
		$query=$this->db->get();// SELECT 'Email' from Gebruiker where 'Email'=$email;
		if ($query->num_rows() > 0){
			$this->form_validation->set_message('email_check', '{field} bestaat al in de database.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	
	// DEZE FUNCTIE IS GETEST :) OP 18-04-2015 @ 09.22
	public function leeftijd_check($date){
		// Controleren of iemand 18 jaar oud is. Standaard formaat is afgedwongen tot MM-DD-YYYY
		$exploded=explode("-",$date);
		$geboortejaar=$exploded[0];
		$Verjaardag = strtotime(str_replace(
								$geboortejaar, 	// bijvoorbeeld 1988
								date('Y'),				// bijvoorbeeld 2015
								$date					// bijvoorbeeld 11/10/1988 -> 11/10/2015
								));
		$Leeftijd = date('Y')-$geboortejaar;		// bijvoorbeeld 2015-1988 -> 27
		
		if(strtotime("now")-$Verjaardag < 0){
			$Leeftijd--;	// nog geen verjaardag gehad// Resultaat 26!
		}
		
		// Leeftijd bekend, nu de controle
		if($Leeftijd < 18){ // Te jong, dus return FALSE
			$this->form_validation->set_message('leeftijd_check', 'Je moet minstens 18 jaar oud zijn voor deze website.');
			return FALSE;
		}else{ // oud genoeg!
			return TRUE;
		}
	}	
	public function minimaxi_check($min,$max){
		if($min>$max){
			$this->form_validation->set_message('minimaxi_check', '{field} moet kleiner zijn dan de maximumleeftijd.');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
?>