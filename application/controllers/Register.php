<?php
// Default controller voor default pagina.

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{

	public function index(){

		$this->load->library('form_validation'); // voor de input validatie van het login formulier

		//validatieregels voor het registreerformulier
		$this->form_validation->set_rules('Nickname', 'Bijnaam', 'trim|required|min_length[4]|alpha_dash');
		$this->form_validation->set_rules('FirstName','Voornaam', 'trim|required|alpha');
		$this->form_validation->set_rules('MiddleName','Tussenvoegsel', 'trim|alpha');
		$this->form_validation->set_rules('LastName','Achternaam', 'trim|required|alpha');
		$this->form_validation->set_rules('password','Wachtwoord','trim|required|alpha_numeric');
		$this->form_validation->set_rules('password_confirm','Wachtwoord','trim|matches[password]');
		$this->form_validation->set_rules('Geboortedatum','Geboortedatum','required');
		$this->form_validation->set_rules('Gender','Geslacht','required');
		$this->form_validation->set_rules('Geboortedatum', 'Geboortedatum','callback_leeftijd_check');
		$this->form_validation->set_rules('Beschrijving','Beschrijving','required');
		$this->form_validation->set_rules('Voorkeur[]','Interresse','required');
		$this->form_validation->set_rules('min','Mimimumleeftijd','less_than_equal_to['.set_value('max').']|required');
		$this->form_validation->set_rules('max','Maximumleeftijd','greater_than_equal_to['.set_value('min').']|required');
		
		

		if($this->form_validation->run()==FALSE){ // als er geen correcte validatie heeft plaatsgevonden.
			$this->pages->view('register',NULL);
		}else{
			$this->pages->view('registratie',NULL);
		}
	}
	
	// DEZE FUNCTIE IS GETEST :) OP 18-04-2015 @ 09.22
	public function leeftijd_check($date){
		// Controleren of iemand 18 jaar oud is. Standaard formaat is afgedwongen tot MM/DD/YYYY
		$exploded=explode("/",$date);
		$geboortejaar=$exploded[2];
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
}
?>